<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class DaftarWarungFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function q($term)
    {
        return $this->where('nama_warung', 'LIKE', "%{$term}%");
    }

    public function provinsi($provinsi)
    {
        $this->where(function ($query) use ($provinsi) {
            $query
                ->where('tempat_sama', false)
                ->whereHas('city', function ($query) use ($provinsi) {
                    $query->when(\is_array($provinsi), function ($query) use ($provinsi) {
                        $query->whereIn('name', $provinsi);
                    })->when(! \is_array($provinsi), function ($query) use ($provinsi) {
                        $query->where('name', $provinsi);
                    });
                });
        })
        ->orWhere(function ($query) use ($provinsi) {
            $query
                ->where('tempat_sama', true)
                ->whereHas('anggota.city', function ($query) use ($provinsi) {
                    $query->when(\is_array($provinsi), function ($query) use ($provinsi) {
                        $query->whereIn('name', $provinsi);
                    })->when(! \is_array($provinsi), function ($query) use ($provinsi) {
                        $query->where('name', $provinsi);
                    });
                });
        });
    }

    public function search($search) {
        return $this->whereHas('anggota', function ($query) use ($search) {
            $query  ->where('nama_pemohon', 'LIKE', "%{$search}%")
                    ->orWhere('no_mitra', 'LIKE', "{$search}%")
                    ->orWhere('nik', 'LIKE', "{$search}%");
        })
        ->orWhere('nama_warung', $search);
    }
}
