<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TujuanPengajuan extends Model
{
    use HasFactory;
    protected $table = 'tujuan_pengajuans';
    public $guarded = ["id"];
}
