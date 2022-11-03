@extends('layouts.default', ['title' => 'Editando: '.$produto['name']])

@section('menu')
<x-menu :user="$user"/>
@endsection


@section('content')
<div class="default-container">

    <div class="default-box">

        <form class="add-product-form" action="{{route('edit.action')}}" method="POST">
            @csrf
            <div class="campos-form-container">
                <div class="campos-form">
                <div class="editing-top">

                    <span> -{{$produto['name']}}</span>
                </div>
                <div class="warn"></div>
                @if ($errors->any())
                @foreach($errors->all() as $error)
                    <p style="color: #FF0000">{{$error}}</p>
                @endforeach
                @endif

                @if(session('danger'))
                <span style="color: #FF0000">{{session('danger')}}</span>
                @endif
                <x-input-form title="Código:" class="codadd" name="identification_number" placeholder="Cód" :value="$produto['identification_number']" validation="identification_number" :readonly="True"/>
                <x-input-form title="Nome do produto:" class="nameadd" name="name" placeholder="Nome" :value="$produto['name']" validation="name" :readonly="False"/>
                <x-input-form-money title="Preço do produto:" class="priceadd" name="price" placeholder="Preço" :value="$produto['price']" validation="price" :readonly="False"/>
                <x-input-form title="Quantidade:" class="qtninitadd" name="quantity" placeholder="Quantidade" :value="$produto['quantity']" validation="quantity" :readonly="False"/>
                <button class="default-button-2" >Enviar</button>
            </div>
            </div>
        </form>
    </div>

</div>
@endsection
@section('footer')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{asset('assets/js/format_money.js') }}"></script>
@endsection
