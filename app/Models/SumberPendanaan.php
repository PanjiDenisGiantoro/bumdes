<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SumberPendanaan extends Model
{
    use HasFactory;
    protected $table = 'sumber_pendanaans';
    public $guarded = ["id"];
}
