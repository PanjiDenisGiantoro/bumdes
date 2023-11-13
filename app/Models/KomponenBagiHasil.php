<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomponenBagiHasil extends Model
{
    use Filterable, HasFactory;

    protected $table = 'komponen_bagi_hasil';

    protected $guarded = [];


    public function gl() {
        return $this->belongsTo(AkunPerkiraan::class, 'gl_id');
    }

}
