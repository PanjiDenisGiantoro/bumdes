<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeratSatuan extends Model
{
    use HasFactory;
    public $guarded = ["id"];
    protected $table = 'berat_satuans';
}
