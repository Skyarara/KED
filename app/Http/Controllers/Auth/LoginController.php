<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;
use Carbon\Carbon;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticate(Request $request)
    {
        $username = User::where('username', $request->username)->value('username');
        if (!$username) {
            return redirect()->back()->with('err_username', 'Tidak dapat menemukan Username');
        }
        $password = User::where('username', $username)->value('password');
        if (Hash::check($request->password, $password)) {
            $user_id = User::where('username', $username)->value('id');
            if ($user_id) {
                Auth::loginUsingId($user_id);
                User::find($user_id)->update(['last_login' => Carbon::now()]);
                return redirect('/daily_activity');
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back()->with('err_password', 'Password Salah')->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
