<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class AkunPerkiraanFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function parent($id)
    {
        return $this->where('parent_id', $id);
    }

    public function descendantOf($id)
    {
        return $this->whereDescendantOf($id);
    }

    public function q($terms)
    {
        return $this->whereLike('nama', "%$terms%");
    }
}
