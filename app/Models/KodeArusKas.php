<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeArusKas extends Model
{
    use HasFactory;
    protected $table = 'kode_kas_arus_aktivitas';
    protected $guarded = ['id'];

}
