<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class RekeningPembiayaanFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function search($search)
    {
        return $this->where(function ($query) use ($search) {
            $query->where('no_akun', 'LIKE', '%' . $search . '%');
        });
    }
}
