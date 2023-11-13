<?php

namespace App\Models;

use App\Models\DaftarProduk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Carts extends Model
{
    use HasFactory;

    protected $table = 'carts';
    protected $guarded = [];
    // protected $fillable = ['produks_id', 'token', 'qty'];
    
    public function product()
    {
        return $this->belongsTo(DaftarProduk::class, 'produks_id');
    }
    public function scopeToken($query)
    {
        return $query->where('token',$this->token);
    } 
}
