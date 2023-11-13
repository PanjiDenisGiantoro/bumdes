<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    //

        public function provinces()
    {
        return \Indonesia::allProvinces();
    }

        public function cities(Request $request)
    {
        return \Indonesia::findProvince($request->id, ['cities'])->cities->pluck('name', 'id');
    }
    public function citiesJakarta()
    {
//        return \Indonesia::findProvince($request->id, ['cities'])->cities->pluck('name', 'id');
        return DB::table('indonesia_cities')->where('province_code',31)->get();
    }
    public function districts(Request $request)
    {
        return \Indonesia::findCity($request->id, ['districts'])->districts->pluck('name', 'id');
    }

        public function villages(Request $request)
    {
        return \Indonesia::findDistrict($request->id, ['villages'])->villages->pluck('name', 'id');
    }

}
