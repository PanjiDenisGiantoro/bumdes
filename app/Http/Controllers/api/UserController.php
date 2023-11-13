<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Mail\kowargiEmail;
use App\Mail\PelangganEmail;
use App\Models\Pelanggan;
use App\Models\User;
use Composer\Util\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Fortify\Rules\Password;
use Symfony\Component\HttpFoundation\Test\Constraint\ResponseFormatSame;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
               'name' => ['required','string','max:255'],
               'email' => ['required','string','max:255','unique:pelanggan','email'],
            ]);
            $password = Str::random(8);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($password),
            ]);
           $pelanggan = Pelanggan::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => $password,
            ]);

            $users = User::where('email',$request->email)->first();

            $email =$pelanggan->password;

            Mail::to($request->email)->send(new PelangganEmail($users,$email));

            $tokenResult = $users->createToken('authToken')->plainTextToken;
            return \response()->json([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $users
            ]);
        }catch (\Exception $error){
            return \response()->json([
                'message' => 'something went wrong',
                'error' => $error
            ]);
        }
    }
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);
            $credentials = request(['email','password']);
            if (!Auth::attempt($credentials)){
                return \response()->json([
                    'message' => 'Unauthorized'
                ]);
            }
            $user = User::where('email',$request->email)->first();

            if (! Hash::check($request->password,$user->password,[])){
                throw new \Exception('Invalid credentials');

            }
            $tokenResult = $user->createToken('authtoken')->plainTextToken;
            return \response()->json([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ]);
        }catch (\Exception $error){
            return \response()->json([
                'message' => 'something went wrong',
                'error' => $error
            ]);
        }
    }
    public function logout(Request $request)
    {
        try {
            $request->user();
            return \response()->json([
                'message' => 'Successfully logged out'
            ]);
        }catch (\Exception $error){
            return \response()->json([
                'message' => 'something went wrong',
                'error' => $error
            ]);
        }
    }
}
