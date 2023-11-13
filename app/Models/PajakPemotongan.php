<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PajakPemotongan extends Model
{
    protected $table = 'perpajakan_keuangans';

    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    public $guarded = ["id"];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        "tanggal_lahir" => "date",
    ];
}
