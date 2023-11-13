<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SisaBayar extends Model
{
    use HasFactory;
    protected $table = 'sisa_bayars';
    public $guarded = ["id"];
}
