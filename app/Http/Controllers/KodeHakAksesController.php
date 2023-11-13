<?php

namespace App\Http\Controllers;

use App\Models\KodeHakAkses;
use App\Models\KodePengguna;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class KodeHakAksesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $KodePengguna = Role::paginate(10);

        return view("tetapan.kode_hak_akses.index",compact('KodePengguna'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $KodePengguna =  KodePengguna::orderBy('nama_jabatan', 'ASC')->get();
        return view("tetapan.kode_hak_akses.form",compact('KodePengguna'));
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
            'name' => 'required|unique:roles',
        ]);
//        $request->merge([
//            'guard_name' => 'web'
//        ]);
        Role::create($request->all());
//        KodeHakAkses::create($request->all());

        return \redirect()
            ->route("kode_hak_akses.index")
            ->with("message", (" Hak Akses Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(KodeHakAkses $kode_hak_akses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('tetapan.kode_hak_akses.edit', compact('role', 'permissions'));

//        return view("tetapan.kode_hak_akses.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KodeHakAkses $kode_hak_akses)
    {
        $kode_hak_akses->fill($request->all());

        $kode_hak_akses->save();

        return redirect()
            ->route("kode_hak_akses.index")
            ->with("message", (" Hak Akses Berhasil Terupdate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(KodeHakAkses $kode_hak_akses)
    {
        //
    }

    public function showPermissions(Role $role)
    {
        $permissions = Permission::all();

        // dd($role->permissions->toArray());

        return view('tenants.admin.roles.permissions', compact('role', 'permissions'));
    }

    public function updatePermissions(Role $role, Request $request)
    {
        $permissions = Permission::whereIn('id', $request->permissions)->get();

        $role->syncPermissions($permissions);

        return redirect()
            ->route('admin.settings.roles.index', ['tab' => $request->query('tab', null)])
            ->with('success', 'Hak akses telah diubah');
    }
}
