@extends('layouts.login')

@section('form')


        <div class="auth-container">
            <div class="auth-box">
                <form action="{{route('auth.user')}}" method="POST">
                    <h1>ENTRAR NO SISTEMA</h1>
                    <hr>
                        @csrf
                        @if ($errors->any())
                        @foreach($errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                        @endif

                        @if(session('danger'))
                        {{session('danger')}}
                        @endif
                    <div class="inputs-auth">
                    <input type="text" name="email" autocomplete="off" placeholder="Email">
                    <input type="password" name="password" autocomplete="off" placeholder="Senha">
                    <button>Fazer Login</button>
                    </div>
                </form>
            </div>
        </div>

@endsection
