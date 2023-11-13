<?php

namespace App\Http\Controllers\Pengajuan;

use App\Http\Controllers\Controller;
use App\Models\User;
//use http\Env\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class RegisterController extends Controller
{
    public function create()
    {
        return view('pengajuans.auth_pengajuan.register');
    }
    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $request->merge(['password' => bcrypt($request->password)]);
        $user = User::create(request(['name', 'email', 'password','telepon']));
        $file = $request->file('gambar');
        if (!empty($file)) {
            Storage::disk('local')->makeDirectory('public/profil/'.$user->id,0775,true);
            $destinationPath = storage_path('app/public/profil/'.$user->id);
            Storage::makeDirectory($destinationPath);
            $extension = $file->getClientOriginalExtension();
            $filesname =$file->getClientOriginalName();
            $image_resize = Image::make($file->getRealPath());
            $image_resize->resize(500,300);
            $image_resize->save($destinationPath.'/'.$filesname,80);
        }
        auth()->login($user);

        return redirect()->to('/pengajuan');
    }

}
