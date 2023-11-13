<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;

class TempImportController extends Controller
{
    public function import(Request $request){

        // dd("arrave");
        $file = $request ->file;

        Excel::import(new UsersImport(), $file);
        echo "Inserted successfully";
    }
}
