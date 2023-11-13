<?php

namespace App\Models;

use App\Facades\Ledger;
use App\Traits\Ledgerable;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Cknow\Money\MoneyCast;
use Cknow\Money\Money;

class RekeningPembiayaan extends Model
{
/**
 * Gabung pokok & margin
 *  - Murabahah     = Jual Beli
 *  - Ijarah        = Sewa
 *  - IMBT          = Sewa beli
 * 
 * Pisah Pokok & margin
 *  - Mudharabah    = Kerjasama modal / bagihasil
 *  - Musyarakah    = Kerjasama Usaha
 *  - Qard          = Kewajiban
 */


    use HasFactory,  Filterable, Ledgerable;

    protected $table = 'rekening';

    public $guarded = ["id"];

    public $appends = ['saldo', 'harga_pokok', 'angsuran_pokok', 'angsuran_margin', 'kewajiban_angsuran'];

    protected $casts = [
        "biaya_admin" => "float",
        "biaya_materai" => "float",
        "biaya_asuransi" => "float",
        "biaya_lain_lain" => "float",
        'tanggal_aktif' => 'date',
        'tanggal_jatuh_tempo' => 'date',
    ];

    // Rekening status
    // const STATUS_PENDING = 0;
    const STATUS_PENDING = 'baru';
    const STATUS_APPROVED = 'disetujui';
    const STATUS_ACTIVE = 'aktif';

    const STATUS_AKAD = 'pencairan';
    const STATUS_REJECTED = 'ditolak';

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('pembiayaan', function (Builder $builder) {
            $builder->where('rekening_type', '=', get_class());
        });

        static::addGlobalScope('pembiayaan_by_cabang', function (Builder $builder) {
            $builder->where('cabang_unit', '=', auth()->user()->cabang_unit);
        });

        static::creating(function ($pembiayaan) {
            $pembiayaan->rekening_type = get_class();
            $pembiayaan->cabang_unit = auth()->user()->cabang_unit;
        });
    }

    public function getStatusTextAttribute()
    {
        switch ($this->attributes['status']) {
            case 'tidak_disetujui':
                $status = 'Tidak Disetujui';
                break;

            case 'disetujui':
                $status = 'Disetujui';
                break;
            default:
                $status = '-';
                break;
        }

        return $status;
    }


    public function getJadwalAttribute() {

        $jangkaWaktu = $this->attributes['jangka_waktu'];
        $nilaiPengajuan = $this->attributes['nilai_pengajuan'] ?? 0;
        $nilaiPembiayaan = $this->attributes['nilai_pembiayaan'] ?? 0;
        $margin = $this->attributes['interest'] ?? 0;

        $sisaPokok = $nilaiPembiayaan - $margin;
        $sisaMargin = $margin;

        $angsuranBulanan = $nilaiPembiayaan / $jangkaWaktu;
        $angsuranPokok = $sisaPokok / $jangkaWaktu;
        $angsuranMargin = $sisaMargin / $jangkaWaktu;


        $jadwal[] = [
            'no' => 0,
            'tanggalAngsuran' => null,
            'angsuranPokok' => 0,
            'angsuranMargin' => 0,
            'angsuranBulanan' => $angsuranBulanan,
            'sisaPokok' => $sisaPokok,
            'sisaMargin' => $sisaMargin,
            'oustanding' => $nilaiPembiayaan,
        ];

        for ($i = 1; $i <= $jangkaWaktu; $i++) {

            $sisaPokok = $sisaPokok - $angsuranPokok;
            $sisaMargin = $sisaMargin - $angsuranMargin;

            $tanggalBuka = $this->tanggal_aktif ?? now();

            $jadwal[] = [
                'no' => $i,
                'tanggalAngsuran' => $tanggalBuka->addMonths($i)->format('d/m/Y'),
                'angsuranPokok' => $angsuranPokok,
                'angsuranMargin' => $angsuranMargin,
                'angsuranBulanan' => $angsuranBulanan,
                'sisaPokok' => $sisaPokok,
                'sisaMargin' => $sisaMargin,
                'oustanding' => $sisaPokok + $sisaMargin,
            ];
        }

        return $jadwal;
    }


    public function getHargaPokokAttribute() {
        $hargaAkhir = $this->attributes['nilai_pembiayaan'] ?? 0;
        $interest = $this->attributes['interest'] ?? 0;
        $hargaPokok = $hargaAkhir - $interest;

        return $hargaPokok;
    }
    public function getAngsuranPokokAttribute() {
        $hargaPokok = $this->getHargaPokokAttribute();
        $jangkaWaktu = $this->attributes['jangka_waktu'] ?? 1;

        $angsuranPokok = $hargaPokok / $jangkaWaktu;

        return $angsuranPokok;
    }
    public function getAngsuranMarginAttribute() {
        $interest = $this->attributes['interest'] ?? 0;
        $jangkaWaktu = $this->attributes['jangka_waktu'] ?? 1;

        $angsuranMargin = $interest / $jangkaWaktu;

        return $angsuranMargin;
    }
    public function getKewajibanAngsuranAttribute() {
        $angsuranPokok = $this->getAngsuranPokokAttribute();
        $angsuranMargin = $this->getAngsuranMarginAttribute();

        $kewajibanAngsuran = $angsuranPokok + $angsuranMargin;

        return $kewajibanAngsuran;
    }

    public function getBiayaAdminAttribute() {
        $admin = $this->attributes['biaya_admin'] ?? $this->produk->biaya_admin ?? 000;
        return $admin;
    }
    public function getBiayaMateraiAttribute() {
        $materai = $this->attributes['biaya_materai'] ?? $this->produk->biaya_materai ?? 0;
        return $materai;
    }
    public function getBiayaAsuransiAttribute() {
        $asuransi = $this->attributes['biaya_asuransi'] ?? $this->produk->biaya_asuransi ?? 0;
        return $asuransi;
    }

    public function getSaldoAttribute(){
        return $this->balance();
    }

    public function getSisaMarginAttribute() {
        $paid = $this->entries->reduce(function ($carry, $item) {
            return $carry + (!empty($item->ledger->margin) ? $item->ledger->margin : 0);
        });

        if (!$paid) {
            $paid = 0;
        }
        // $paid = Money::parse($paid, config('money.defaultCurrency'));

        $margin = $this->attributes['interest'] ?? 0;
        // $marginConv = Money::parse($margin, config('money.defaultCurrency'));

        return $margin - $paid;
    }

    public function getOutstandingAttribute() {
        $akad = $this->akads->jenis_akad;
        $saldo = $this->getSaldoAttribute();
        $sisaMargin = $this->getSisaMarginAttribute();

        // if ($akad == 'mudharabah' || $akad == 'musyarakah' || $akad == 'qard') {
            $outstanding = $saldo + $sisaMargin;
            return $outstanding;
        // } else {
        //     return $saldo;
        // }
    }


    public function anggota() {
        return $this->belongsTo(Anggota::class);
    }

    public function akunOfficer() {
        return $this->belongsTo(AkunOfficer::class, 'ao_id', 'id');
    }

    public function produk() {
        return $this->belongsTo(ProdukRekeningPembiayaan::class);
    }

    public function ledgerable()
    {
        return $this->morphTo();
    }
    public function akads() {
        return $this->hasOne(Akad::class,'id','pilihan_akad');
    }
    public function tujuan_pengajuans() {
        return $this->hasOne(TujuanPengajuan::class,'id','tujuan_pengajuan');
    }
    public function sumber_danas() {
        return $this->hasOne(SumberDana::class,'id','sumber_dana');
    }
    public function ledger(){
        return $this->hasOne(LedgerEntry::class,'ledgerable_id','id');
    }
    public function ledgers(){
        return $this->hasMany(LedgerEntry::class, 'ledgerable_id', 'id');
    }

    public function rekAutodebet() {
        return $this->belongsTo(RekeningSimpanan::class, 'rek_autodebet', 'id');
    }

    // public function balance()
    // {
    //     return Ledger::balance($this) * -1;
    // }


    public function debit($from, $amount, $amount_currency="UGX", $reason, $ledger_id)
    {
        // $amount = $amount * -1;

        return Ledger::debit($this, $from, $amount, $amount_currency, $reason, $ledger_id);
    }

    public function credit($to, $amount, $amount_currency="UGX", $reason, $ledger_id)
    {
        // $amount = $amount * -1;

        return Ledger::credit($this, $to, $amount, $amount_currency, $reason, $ledger_id);
    }

}
