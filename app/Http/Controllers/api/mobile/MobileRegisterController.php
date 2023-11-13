<?php

namespace App\Http\Controllers\api\mobile;

use App\Http\Controllers\Controller;
use App\Models\DaftarProduk;
use App\Models\pengajuan\Pengajuan;
use App\Models\Zpengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Image;

class MobileRegisterController extends Controller
{
    public function login(Request $request){
        $data = $request->all();
        $username = $data['username'];
        $password = $data['password'];
        $user =DB::table('zusers')->where('username',$username)->where('password',$password)->first();
        if($user){
            if($user->password == $password){
                return response()->json(['status' => 'success', 'data' => $user]);
            }
        }else{
            return response()->json(['status' => 'error', 'message' => 'Password Salah']);
        }
    }
    public function register(Request $request){
        $data = $request->all();
        $username = $data['username'];
        $password = $data['password'];
        $email = $data['email'];
        $user =DB::table('zusers')->where('username',$username)->where('password',$password)->first();
        if($user){
            return response()->json(['status' => 'error', 'message' => 'Username Sudah Ada']);
        }else{
            $user = DB::table('zusers')->insert([
                'email' => $email,
                'username' => $username,
                'password' => $password,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            if($user){
                return response()->json(['status' => 'success', 'message' => 'Berhasil Registrasi']);
            }else{
                return response()->json(['status' => 'error', 'message' => 'Gagal Registrasi']);
            }
        }
    }
    public function pengajuan(Request $request){
        $data = $request->all();
        $nik = $data['nik'];
        $pengajuan = DB::table('zpengajuans')->where('nik',$nik)->first();
        if($pengajuan){
            return response()->json(['status' => 'error', 'message' => 'Pengajuan Sudah Ada']);
        }else{
            $pengajuan = Zpengajuan::create($request->all());
            $file = $request->file('file_ktp');
            if (!empty($file)) {
                $file->storeAs('ktp_pengajuan/' . $pengajuan->id, '' . $file->getClientOriginalName(), 'public');
            }
            $file_serfie = $request->file('file_serfie');
            if (!empty($file_serfie)) {
                $file_serfie->storeAs('selfi_pengajuan/' . $pengajuan->id, '' . $file_serfie->getClientOriginalName(), 'public');
            }
            $file = $request->file('file_ktpg');
            if (!empty($file)) {
                Storage::disk('local')->makeDirectory('public/warung0_pengajuan/'.$pengajuan->id,0775,true);
                $destinationPath = storage_path('app/public/warung0_pengajuan/'.$pengajuan->id);
                Storage::makeDirectory($destinationPath);
                $extension = $file->getClientOriginalExtension();
                $filesname =$file->getClientOriginalName();
                $image_resize = Image::make($file->getRealPath());
                $image_resize->resize(500,300);
                $image_resize->save($destinationPath.'/'.$filesname,80);
            }
            $file1 = $request->file('file_fktp2');
            if (!empty($file1)) {
                Storage::disk('local')->makeDirectory('public/warung1_pengajuan/'.$pengajuan->id,0775,true);
                $destinationPath = storage_path('app/public/warung1_pengajuan/'.$pengajuan->id);
                Storage::makeDirectory($destinationPath);
                $extension = $file1->getClientOriginalExtension();
                $filesname =$file1->getClientOriginalName();
                $image_resize = Image::make($file1->getRealPath());
                $image_resize->resize(500,300);
                $image_resize->save($destinationPath.'/'.$filesname,80);
            }
            if($pengajuan){

                return response()->json(['status' => 'success', 'message' => 'Berhasil Pengajuan']);
            }else{
                return response()->json(['status' => 'error', 'message' => 'Gagal Pengajuan']);
            }
        }
    }
    public function viewPengajuan(Request $request){
        if ($request->from != '' && $request->to != '') {
            $pengajuan = Zpengajuan::whereBetween('created_at', [$request->from, $request->to])->get();
            return response()->json(['status' => 'success', 'data' => $pengajuan]);

        } else {
            $pengajuan = Zpengajuan::all();
            return response()->json(['status' => 'failed', 'data' => $pengajuan]);

        }


    }
    public function detailPengajuan($id = null){
        $pengajuan = Zpengajuan::where('nik',$id)->first();
        if($pengajuan){
            return response()->json(['status' => 'success', 'data' => $pengajuan]);
        }else{
            return response()->json(['status' => 'error', 'message' => 'Data Tidak Ditemukan']);
        }
    }
    public function getRasio(){
        $rasio = DB::table('rasios')->first();
        if($rasio){
            return response()->json(['status' => 'success', 'data' => $rasio]);
        }
    }
    public function getMargin(){
        $margin = DB::table('margins')->first();
        if($margin){
            return response()->json(['status' => 'success', 'data' => $margin]);
        }
    }
    public function getDurasi(){
        $durasi = DB::table('durasis')->first();
        if($durasi){
            return response()->json(['status' => 'success', 'data' => $durasi]);
        }
    }

    public function provinces()
    {
        $provinces =  \Indonesia::allProvinces();
        return response()->json(['status' => 'success', 'data' => $provinces]);
    }

    public function cities(Request $request)
    {
        $cities = DB::table('indonesia_cities')->where('province_code', $request->id)->get();
             return response()->json(['status' => 'success', 'data' => $cities]);
    }
    public function district(Request $request)
    {
        $districts = DB::table('indonesia_districts')->where('city_code', $request->id)->get();
        return response()->json(['status' => 'success', 'data' => $districts]);
    }
    public function villages(Request $request)
    {
        $villages = DB::table('indonesia_villages')->where('district_code', $request->id)->get();
        return response()->json(['status' => 'success', 'data' => $villages]);
    }
    public function logout(){
        Auth::logout();
        return redirect('/login_pengajuan');
    }

}
