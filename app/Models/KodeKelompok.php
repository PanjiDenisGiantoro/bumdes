<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class KodeKelompok extends Model
{
    use HasFactory, NodeTrait;

    public const JENIS = [
        'A' => 'Aset',
        'L' => 'Kewajiban',
        'C' => 'Modal',
        'I' => 'Pendapatan',
        'E' => 'Beban/Biaya',
        'G' => 'Harga Pokok Penjualan',
    ];

    public $table = 'akuns';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    public $guarded = ["id"];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        "tanggal_pengajuan" => "date",
    ];

    public function warung()
    {
        return $this->belongsTo(Warung::class);
    }
}
