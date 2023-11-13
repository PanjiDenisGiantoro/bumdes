<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingBatch extends Model
{
    use HasFactory;
    public $guarded = ["id"];
    protected $table = 'setting_batchs';
    public function sumber_pendanaans()
    {
        return $this->hasOne(SumberPendanaan::class,'id','id_sumber_pendanaan');
    }
    public function akun_perkiraans() {
        return $this->hasOne(AkunPerkiraan::class,'id','GL_batch_pendanaan');
    }
    public function coa() {
        return $this->belongsTo(AkunPerkiraan::class, 'gl_pendana');
    }
}
