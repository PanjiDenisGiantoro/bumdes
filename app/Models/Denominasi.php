<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Denominasi extends Model
{
    use HasFactory, Userstamps;

    public $guarded = ["id"];
    protected $table = 'denominasi';

    // public function getTotalAmountAttribute()
    // {
    //     $total = 0;

    //     foreach ([100, 200, 500, 1000, 1001, 2000, 5000, 10000, 20000, 50000, 75000, 100000] as $i => $deno) {
    //         $total += str_replace(',', '', $this->attributes["value_$deno"] ?? 0);
    //     }

    //     return $total;
    // }
}
