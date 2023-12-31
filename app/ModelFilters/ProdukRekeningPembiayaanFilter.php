<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class ProdukRekeningPembiayaanFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];


    public function id($id) {
        return $this->where('akad_pembiayaan', '=', $id);
    }

    public function akad($akad) {
        return $this->where('akad_pembiayaan', '=', $akad);
    }

}
