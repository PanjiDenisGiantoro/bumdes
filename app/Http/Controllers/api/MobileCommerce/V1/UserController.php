<?php

namespace App\Http\Controllers\api\MobileCommerce\V1;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class UserController extends Controller
{
 
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'userRekening']]); // FIXME: Temporary disable all auth tokening
    }


    public function login(Request $request) {
        // Auth::attempt(['email' => $email], $remember)
        // return $user->createToken('token-name', ['server:update'])->plainTextToken;

        $user = Anggota::where('no_mitra', '=', $request->no_anggota)->first();

        if ($user) {
            return ResponseBuilder::success($user);
        } else {
            return ResponseBuilder::error(401, null, [
                'message' => 'not exist',
            ]);
        }
    }

    public function userRekening($id) {
        $user = Anggota::where('id', $id)
            ->with('rekenings', function ($query) {
                $query->where('status', '=', 'aktif')->with('produk');
            })
            ->first();

        if ($user) {
            return ResponseBuilder::success($user);
        } else {
            return ResponseBuilder::error(401, null, [
                'message' => 'User not found',
            ]);
        }
    }

}
