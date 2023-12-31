<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use Midtrans\Config;
use Midtrans\Notification;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
    public function callback()
    {
        // konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // buat instance midtrans notification
        $notification = new Notification();

        //assign ke variable untuk memudahkan coding
        $status = $notification->transaction_status;
        $type   = $notification->payment_type;
        $fraud  = $notification->fraud_status;
        $order_id = $notification->order_id;

        $transaction = Pengiriman::findOrFail($order_id);

        // handle notifikasi status midtrans
        if($status == 'capture')
        {
            if($type == 'credit_card')
            {
                if($fraud == 'challenge')
                {
                    $transaction->status = 'PENDING';
                } else {
                    $transaction->status = 'SUCCESS';
                }
            }
        }
        else if ($status == 'settlement')
        {
            $transaction->status = 'SUCCESS';
        }
        else if($status == 'pending')
        {
            $transaction->status = 'PENDING';
        }
        else if($status == 'deny')
        {
            $transaction->status == 'CANCELLED';
        }
        else if($status == 'expire')
        {
            $transaction->status == 'CANCELLED';
        }
        else if($status == 'cancel')
        {
            $transaction->status == 'CANCELLED';
        }

        $transaction->save();
    }

    public function success()
    {
        return view('midtrans.success');
    }

    public function unfinish()
    {
        return view('midtrans.unfinish');
    }

    public function error()
    {
        return view('midtrans.error');
    }
}
