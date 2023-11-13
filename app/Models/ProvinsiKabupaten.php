<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvinsiKabupaten extends Model
{
    use  HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'provinsi_kabupaten';

    /**
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param string $provinsi
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeProvinsi($query, $provinsi)
    {
        return $query->where('provinsi', '=', $provinsi);
    }
}
