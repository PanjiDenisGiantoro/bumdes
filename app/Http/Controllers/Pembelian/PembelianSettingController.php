<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PembelianSettingController extends Controller
{
    public function index()
    {
        return view('pembelian.setting.setting');
    }
}
