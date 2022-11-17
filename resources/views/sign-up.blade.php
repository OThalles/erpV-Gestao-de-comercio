@extends('layouts.auth')

@section('form')


        <div class="auth-container">
            <div class="auth">
                <div class="title">
                    <h1>Cadastre-se</h1>
                    <hr class="center-diamond">
                </div>
                <form action="{{route('signupaction')}}" method="POST">
                        @csrf
                        @if ($errors->any())
                        @foreach($errors->all() as $error)
                            <p style="color: #FF0000">{{$error}}</p>
                        @endforeach
                        @endif

                        @if(session('danger'))
                           <p style="color: #FF0000">{{session('danger')}}</p>
                        @endif
                    <div class="inputs-auth">
                        <p>Nome *:</p>
                    <input type="text" name="name" autocomplete="off" placeholder="Insira seu nome">
                        <p>Email *:</p>
                    <input type="text" name="email" autocomplete="off" placeholder="Insira seu e-mail">
                        <p>Senha *:</p>
                    <input type="password" name="password" autocomplete="off" placeholder="Insira sua senha">
                    @if(config('services.recaptcha.key'))
                    <div class="g-recaptcha"
                        data-sitekey="{{config('services.recaptcha.key')}}">
                    </div>
                    @endif
                    <br/>
                    <button>Fazer Login</button>
                    </div>
                </form>
            </div>
        </div>

@endsection
