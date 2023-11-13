<?php

namespace App\Http\Controllers\Pengajuan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function back;
use function redirect;
use function view;

class LoginController extends Controller
{
    public function view(){
        return view('pengajuans.auth_pengajuan.login');
    }
    public function actionlogin(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|string'
        ]);
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard_pengajuan');
        }

        return back()->with([
            'loginError' => 'email atau Password salah',
        ]);
    }
    public function actionlogout()
    {
        Auth::logout();
        return redirect('/login_pengajuan');
    }
}
