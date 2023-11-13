<?php

namespace App\Http\Controllers;

use App\Models\KodePengguna;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

use App\Models\Role;
class RoleController extends Controller
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
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(\Spatie\Permission\Contracts\Role $role,$id)
    {
//        $permissions = Permission::with('roles')->get();
        $permissions = Permission::with([
            'roles' => function ($query) use ($id) {
                $query->where('role_id', '=', $id);
            }
        ])->get();
//        foreach permission relation roles


//        $permissions = Permission::all();

//        permission role
        $role = Role::find($id);
//        $permission_role = $role->permissions->pluck('id')->toArray();
//        $role = \App\Models\Role::find($id);
        return view('tetapan.kode_hak_akses.edit', compact('role', 'permissions'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {

        $permissions = Permission::whereIn('id', $request->permissions)->get();
        $role = Role::with('permissions')->find($request->id);
        $role->syncPermissions($permissions);
        return redirect()
            ->route('kode_hak_akses.index')
            ->with('message', 'Hak akses Terupdate');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {

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
