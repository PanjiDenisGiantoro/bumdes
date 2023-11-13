<?php

namespace App\Models;

use App\Traits\Ledgerable;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class AkunPerkiraan extends Model
{
    use Filterable, HasFactory, Ledgerable, NodeTrait;

    public $table = 'akuns';

    public $appends = ['sub_kode', 'saldo'];

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

    public function getGlTypeAttribute() {
        $temp = $this->getAncestors()->where('jenis', '!=', '')->first();
        if ($temp) {
            return $temp->jenis;
        } else {
            return $this->attributes['jenis'];
        }
    }

    public function warung()
    {
        return $this->belongsTo(Warung::class);
    }

    public function getSubKodeAttribute()
    {
        return $this->attributes['kode'];
    }

    public function getKodeAttribute()
    {
        return \implode('.', array_filter([$this->parent->kode ?? '', $this->attributes['kode']]));
    }

    public function getSaldoAttribute()
    {
        return $this->balance();
    }
}
