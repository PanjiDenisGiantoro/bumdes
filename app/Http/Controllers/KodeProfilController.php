<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Mail\kowargiEmail;
use App\Models\KodeProfil;
use Illuminate\Support\Str;
use App\Models\KodePengguna;
use Illuminate\Http\Request;
use App\Models\AkunPerkiraan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use PhpParser\Node\Expr\Assign;

class KodeProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kodeProfil = KodeProfil::orderBy('created_at', 'DESC')->paginate(10);


        return view("tetapan.kode_profil.index",compact('kodeProfil'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $KodePengguna =  KodePengguna::orderBy('nama_jabatan', 'ASC')->get();
       $roles = Role::orderBy('name', 'ASC')->get();
       $akuns = AkunPerkiraan::where('kode','like','0%')->orderBy('_lft','ASC')->get();
    //    ddd($roles);
        return view("tetapan.kode_profil.form",compact('KodePengguna', 'roles', 'akuns'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email_perusahaan' => 'required|unique:kode_profils',
            'id_pengguna' => 'required|unique:kode_profils',
        ]);
        $password = Str::random(8);
        $request->merge([
            'passwordd' => $password
        ]);
       $profil = KodeProfil::create($request->all());
         $password_user = $profil->passwordd ;

        $user = User::create([
            'name' => $request->nama_pegawai,
            'email' => $request->email_perusahaan,
            'password' => Hash::make($profil->passwordd),
            'profil_id' => $profil->id,
            'cabang_unit' => auth()->user()->cabang_unit
        ]);

        // assign role to user
        $user->assignRole($request->hak_akses);
        // AssignRole::create([
        //     'user_id' => $user->id,
        //     'role_id' => $request->hak_akses
        // ]);

        //  setting di live
        // Mail::to($request->email_perusahaan)->send(new kowargiEmail($user,$password_user));
        return \redirect()
            ->route("kode_profil.index")
            ->with("message",(" Pegawai Berhasil Terdaftar"));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(KodeProfil $request,$id)
    {
        $KodeProfil = KodeProfil::where('id',$id)->first();
        $KodePengguna =  KodePengguna::orderBy('nama_jabatan', 'ASC')->get();

        return view("tetapan.kode_profil.show", \compact("KodeProfil",'KodePengguna'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(KodeProfil $request,$id)
    {
        $KodeProfil = KodeProfil::where('id',$id)->first();
        $KodePengguna =  KodePengguna::orderBy('nama_jabatan', 'ASC')->get();
        return view("tetapan.kode_profil.form", \compact("KodeProfil",'KodePengguna'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kode_profil = KodeProfil::find($id);

        $kode_profil->fill($request->all());

        $kode_profil->save();

        return redirect()
            ->route("kode_profil.index")
            ->with("message", ("  Pegawai Berhasil Terupdate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        $bidangusaha = KodeProfil::where('email_perusahaan',$id);
        $bidangusaha->delete();
        $email = User::where('email',$id);
        $email->delete();
        return redirect()
            ->route("kode_profil.index")
            ->with("message", ("  Pegawai Berhasil Terhapus"));
    }
}
