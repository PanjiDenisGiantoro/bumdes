<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokAset extends Model
{
    use HasFactory;
    public $guarded = ["id"];
    protected $casts = [
        "tanggal_pengajuan" => "date",
    ];
    protected $table = 'kelompok_asets';

}
