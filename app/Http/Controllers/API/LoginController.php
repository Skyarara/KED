<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Carbon;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $response = [];
        if ($request->username == null || $request->password == null) {
            return response()->json(['error' => 'terdapat parameter kosong'], 401);
        } else if (User::where('username', $request->username)->first() == null) {
            return response()->json(['error' => 'username tidak ditemukan'], 401);
        }
        $password = User::where('username', $request->username)->value('password');
        if (Hash::check($request->password, $password)) {
            $user_id = User::where('username', $request->username)->value('id');
            $user = Auth::loginUsingId($user_id);
            $user->update(['last_login' => Carbon::now()]);
            $token = $user->createToken('MyApp')->accessToken;
            $response = [
                'code' => 200,
                'message' => 'Sukses Login',
                'data' => [
                    'id' => (int) $user->id,
                    'username' => $user->username,
                    'token'    => $token
                ],
            ];
            return response()->json($response, 200);
        } else {
            return response()->json(['error' => 'password salah'], 401);
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::user()->AauthAcessToken()->delete();
            $response = [
                'code' => 200,
                'message' => 'Berhasil Logout',
                // 'data' => [
                //     'id' => (int) $user->id,
                //     'username' => $user->username,
                //     'token'    => $token
                // ],
            ];
            return response()->json($response, 200);
        } else {
            return response()->json(['error' => 'Anda Belum Login'], 401);
        }
    }
}
