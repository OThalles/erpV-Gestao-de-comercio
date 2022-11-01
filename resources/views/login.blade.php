@extends('layouts.auth')

@section('form')


        <div class="auth-container">

                <div class="auth">
                    <div class="title">
                        <h1>Faça Login</h1>
                        <hr class="center-diamond">
                    </div>
                <form action="{{route('auth.user')}}" method="POST">
                        @csrf
                        @if ($errors->any())
                        @foreach($errors->all() as $error)
                            <p style="color: #FF0000">{{$error}}</p>
                        @endforeach
                        @endif

                        @if(session('danger'))
                        <span style="color: #FF0000">{{session('danger')}}</span>
                        @endif
                    <div class="inputs-auth">
                        <p>Email *:</p>
                    <input type="text" name="email" autocomplete="off" placeholder="Insira aqui seu e-mail">
                        <p>Senha *:</p>
                    <input type="password" name="password" autocomplete="off" placeholder="Insira aqui sua senha">
                    @if(config('services.recaptcha.key'))
                    <div class="g-recaptcha"
                        data-sitekey="{{config('services.recaptcha.key')}}">
                    </div>
                    @endif
                    <button>Fazer Login</button>
                    </div>

                </form>
                </div>
        </div>

@endsection
