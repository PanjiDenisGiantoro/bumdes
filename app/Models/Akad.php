<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akad extends Model
{
    use HasFactory;
    protected $table = 'akads';
    public $guarded = ["id"];
}
