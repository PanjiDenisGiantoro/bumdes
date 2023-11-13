<?php

namespace App\Models\pengajuan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class durasi extends Model
{
    use HasFactory;
    protected $table = 'durasis';
    protected $guarded = ['id'];
}
