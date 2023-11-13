<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zuser extends Model
{
    use HasFactory;
    protected $table = 'zusers';
    protected $guarded = ['id'];
}
