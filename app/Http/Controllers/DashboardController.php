<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function home() {

        return view('inicio', ['menu' => 'inicio', 'user' => Auth::User()]);
    }
}
