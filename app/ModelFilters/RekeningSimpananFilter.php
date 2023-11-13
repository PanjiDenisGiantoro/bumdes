<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class RekeningSimpananFilter extends ModelFilter
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
        return $this->Where('no_akun', $search);;
    }

    // Used at:
    // 1- Laporan Simpanan->produk 
    // 2- Laporan Berjangka->produk
    public function produkId($id_produk) {

        return $this->where('produk_id', '=', $id_produk);
    }
    
    // Used at:
    // 1- Laporan Simpanan->Rekening
    public function simpananId($id_simpanan) {

        return $this->where('id', '=', $id_simpanan);
    }
}
