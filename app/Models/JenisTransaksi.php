<?php

namespace App\Models;

use App\Casts\ToggleSwitch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisTransaksi extends Model
{
    use HasFactory;

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
        'kredit' => ToggleSwitch::class,
    ];

    public function warung()
    {
        return $this->belongsTo(Warung::class);
    }

    public function akun_perkiraan()
    {
        return $this->belongsTo(AkunPerkiraan::class, 'akun_id');
    }
}
