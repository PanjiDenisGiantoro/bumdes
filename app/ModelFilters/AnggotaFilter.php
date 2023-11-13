<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class AnggotaFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function regEmail($email) {
        return $this->where('email', '=', $email);
    }
    public function regMitra($no_mitra) {
        return $this->where('no_mitra', '=', $no_mitra);
    }
    public function regNama($nama) {
        return $this->where('nama_pemohon', '=', $nama);
    }
    public function regNik($nik) {
        return $this->where('nik', '=', $nik);
    }
    public function id($id) {
        return $this->where('id', '=', $id);
    }

    public function search($search) {
        return $this->where(function($query) use ($search) {
            $query->where('nama_pemohon', 'LIKE', '%'.$search.'%')
            ->orWhere('nik', 'LIKE', '%'.$search.'%')
            ->orWhere('no_mitra', 'LIKE', '%'.$search.'%')
            ->orWhere('email', 'LIKE', '%'.$search.'%');
        });
        // return $this->whereHas('anggota', function ($query) use ($search) {
        //     $query  ->where('nama_pemohon', 'LIKE', "%{$search}%")
        //             ->orWhere('no_mitra', 'LIKE', "{$search}%")
        //             ->orWhere('nik', 'LIKE', "{$search}%");
        // });
    }
}
