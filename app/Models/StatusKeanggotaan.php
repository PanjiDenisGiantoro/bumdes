<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusKeanggotaan extends Model
{
    use HasFactory;
    protected $table = 'status_keanggotaan';
    public $guarded = ["id"];
    protected $casts = [
        "tanggal_pengajuan" => "date",
    ];
}
