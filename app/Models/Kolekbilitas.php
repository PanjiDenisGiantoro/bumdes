<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kolekbilitas extends Model
{
    use HasFactory;

    protected $table = 'kolektibilitas';
    public $guarded = ["id"];
}
