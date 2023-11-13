<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        $prefix = $request->route()->action['prefix'];

        $roles = \Spatie\Permission\Models\Role::where('nama_pemohon', '!=', 'Anggota')
        ->get()
        ->pluck('name')
        ->toArray();

    //     if (!empty($roles)) {
    //     if ($prefix == null && $user->hasRole($roles)) {
    //         return redirect()->route('admin.home');
    //     }
    // }

        return $next($request);
    }
}
