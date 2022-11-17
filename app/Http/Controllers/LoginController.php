<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login() {
        return view('login');
    }

    public function signup() {
        return view('sign-up');
    }

    public function signupaction(Request $r) {
        $this->validate($r,[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ],[
            'name' => 'required',
            'email.required' => "E-mail é obrigatório",
            'email.email' => "Esse email não é valido",
            'password.required' =>"Senha é obrigatória"
        ]);
        $user = User::where('email',$r->email)->first();
        if($user == null) {
            User::insert(
                [
                    'name' => $r->name,
                    'email' => $r->email,
                    'password' => Hash::make($r->password)
                ]
            );
            return redirect()->route('login')->with('completed-registration', 'Você se registrou, já pode entrar');
        }

        return redirect()->back()->with('danger', 'Já tem um usuario com esse email');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('login');
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
            return redirect()->back()->with('danger','Email ou senha inválidos');
        }
    }
}
