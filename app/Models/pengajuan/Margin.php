<?php

namespace App\Models\pengajuan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Margin extends Model
{
    use HasFactory;
    protected $table = 'margins';
    protected $guarded = ['id'];
}
