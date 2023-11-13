<?php

namespace App;

use App\Exceptions\InsufficientBalanceException;
use App\Exceptions\InvalidRecipientException;
use Illuminate\Routing\Router;

class Ledger
{
    /**
     * @var Router
     */
    protected $router;

    /**
     * Ledger constructor.
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * debit a ledgerable instance
     *
     * @param $to
     * @param string $from
     * @param $amount
     * @param $reason
     * @return mixed
     *
     *                      Bertambah   |   Berkurang
     * A => Asset           -debet          - credit
     * E => Beban/Biaya     -debet          - credit
     * L => Kewajiban       -credit         - debet
     * C => Modal           -credit         - debet
     * I => Pendapatan      -credit         - debet
     *
     * GL Pendapatan always credit, jarang debit. kecuali kalau ada pembetulan lewat jurnal entry
     *
     */
    public function debit($to, $from, $amount, $amount_currency, $reason,$ledger_id)
    {
        $balance = $to->balance();
        $current_balance_currency = isset($to->current_balance_currency) ? $to->current_balance_currency : Null;

        $controled_amount = $amount;
        if ($to->gl_type == 'L' || $to->gl_type == 'C' || $to->gl_type == 'I') { // 'I" GL Pendapatan pembiayaan            
        // if ($to->gl_type == 'A' || $to->gl_type == 'E') {
            $controled_amount = $amount * -1;
        }


        $data = [
            'money_from' => $from,
            'debit' => 1,
            'reason' => $reason,
            'amount' => $amount,
            'amount_currency' => $amount_currency,
            // 'current_balance' => (float)$balance + (float)$amount,
            'current_balance' => (float)$balance + (float)$controled_amount,
            'current_balance_currency' => $current_balance_currency,
            'ledger_id' => $ledger_id,
        ];

        return $this->log($to, $data);
    }

    /**
     * credit a ledgerable instance
     *
     * @param $from
     * @param string $to
     * @param $amount
     * @param $reason
     * @return mixed
     * @throws InsufficientBalanceException
     */
    public function credit($from, $to, $amount, $amount_currency="UGX", $reason,$ledger_id)
    {
        $balance = $from->balance();
        $current_balance_currency = isset($from->current_balance_currency) ? $from->current_balance_currency : Null;

        $controled_amount = $amount;
        if ($from->gl_type == 'L' || $from->gl_type == 'C' || $from->gl_type == 'I') {       
        // if ($from->gl_type == 'A' || $from->gl_type == 'E') {
            $controled_amount = $amount * -1;
            // dump($amount);
            // dump($controled_amount);
            // dump($balance);
            // dd((float)$balance - (float)$controled_amount);
        }

        $data = [
            'money_to' => $to,
            'credit' => 1,
            'reason' => $reason,
            'ledger_id' => $ledger_id,
            'amount' => $amount,
            'amount_currency' => $amount_currency,
            // 'current_balance' => (float)$balance - (float)$amount,
            'current_balance' => (float)$balance - (float)$controled_amount,
            'current_balance_currency' => $current_balance_currency
        ];

        return $this->log($from, $data);
    }

    /**
     * persist an entry to the ledger
     *
     * @param $ledgerable
     * @param array $data
     * @return mixed
     */
    protected function log($ledgerable, array $data)
    {
        return $ledgerable->entries()->create($data);
    }

    /**
     * balance of a ledgerable instance
     *
     * @param $ledgerable
     * @return float
     */
    public function balance($ledgerable)
    {
        $credits = $ledgerable->credits()->sum('amount');
        $debits = $ledgerable->debits()->sum('amount');
        // $balance = $debits - $credits;
        // dd($ledgerable->gl_type);
        if ($ledgerable->gl_type == 'L' || $ledgerable->gl_type == 'C' || $ledgerable->gl_type == 'I') {
            $balance = $credits - $debits;
        } else {
            $balance = $debits - $credits;
        }
        return $balance;
    }

    /**
     * transfer an amount to each ledgerable instance
     *
     * @param $from
     * @param $to
     * @param $amount
     * @param string $reason
     * @return mixed
     * @throws InvalidRecipientException
     * @throws InsufficientBalanceException
     */
    public function transfer($from, $to, $amount, $amount_currency="UGX", $reason = "funds transfer")
    {
        if (!is_array($to))
            return $this->transferOnce($from, $to, $amount, $amount_currency, $reason);

        $total_amount = (float)$amount * count($to);
        if ($total_amount > $from->balance())
            throw new InsufficientBalanceException("Insufficient balance");

        $recipients = [];
        foreach ($to as $recipient)
        {
            array_push($recipients, $this->transferOnce($from, $recipient, $amount, $amount_currency, $reason));
        }

        return $recipients;
    }

    /**
     * transfer an amount to one ledgerable instance
     *
     * @param $from
     * @param $to
     * @param $amount
     * @param $reason
     * @return mixed
     * @throws InsufficientBalanceException
     * @throws InvalidRecipientException
     */
    protected function transferOnce($from, $to, $amount, $amount_currency="UGX", $reason)
    {
        if (get_class($from) == get_class($to) && $from->id == $to->id)
            throw new InvalidRecipientException("Source and recipient cannot be the same object");

        $this->credit($from, $to->name, $amount, $amount_currency ,$reason);
        return $this->debit($to, $from->name, $amount, $amount_currency, $reason);
    }

    /**
     * register routes for ledger api access
     */
    public function routes()
    {
        $this->router->group(['namespace' => 'FannyPack\Ledger\Http\Controllers', 'prefix' => 'entries'], function() {
            $this->router->get('ledger', 'LedgerController@index');
            $this->router->get('ledger/{entry_id}', 'LedgerController@show');
        });
    }
}
