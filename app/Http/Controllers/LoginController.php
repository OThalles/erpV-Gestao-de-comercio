<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login() {
        return view('login');
    }

    public function signin() {
        return view('sign-in');
    }

    public function loginApi(Request $request) {
        if(Auth::attempt(['email' => $r->email, 'password' =>$r->password])) {
            $token = Auth::user()->createToken('auth_token');
            return response()->json([
                            'data' => [
                                'token' => $token->plainTextToken
                            ]
                            ]);

            abort(401, 'Invalid Credentials');
        }

    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('login');
    }


    public static function IsLogged() {
        return session()->has('user') ? session('user') : False;
    }

    public function auth(Request $r) {
        $this->validate($r,[
            'email' => 'required',
            'password' => 'required'
        ],[
            'email.required' => "E-mail é obrigatório", //Para traduzir o padrao do laravel
            'password.required' =>"Senha é obrigatória"
        ]);

        if(Auth::attempt(['email' => $r->email, 'password' =>$r->password])) {
            session()->put('user', Auth::User());
            return redirect()->route('main');
        } else{
            return redirect()->back()->with('danger','Email ou senha inválido');
        }
    }
}
