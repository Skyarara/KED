<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class HomeController extends Controller
{
    public function landing_page()
    {
        return view('home');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin()
    {
        return view('welcome');
    }

    public function home()
    {
        return view('dashboard');
    }

    public function login_page()
    {
        return view('login.page');
    }
}
