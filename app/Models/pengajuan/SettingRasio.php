<?php

namespace App\Models\pengajuan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingRasio extends Model
{
    use HasFactory;
    protected $table = 'setting_rasios';
    protected $guarded = ['id'];
}
