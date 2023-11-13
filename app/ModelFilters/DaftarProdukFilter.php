<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class DaftarProdukFilter extends ModelFilter
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
//        if (!empty($search['value'])) {
//            return $this->whereLike('nama_produk', "%$search[value]%")
//                ->orWhere('no_barcode', $search['value']);
//        }
        if (!empty($search['value'])) {
            return $this->where('nama_produk', "$search[value]")
                ->orWhere('no_barcode', $search['value']);
        }
    }
}
