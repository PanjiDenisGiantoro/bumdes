<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class AkunOfficerFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    // used by AO in LaporanAOController->aoIndex
    public function id($id)
    {
        return $this->where('id', '=', $id);
    }
}
