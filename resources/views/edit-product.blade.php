@extends('layouts.default', ['title' => 'Editando: '.$produto['name']])

@section('menu')
<x-menu :user="$user"/>
@endsection


@section('content')
<div class="default-container">

    <div class="default-box">

        <form class="add-product-form" action="{{route('edit.action')}}" method="GET">
            <div class="campos-form-container">
                <div class="campos-form">
                <div class="editing-top">

                    <span> -{{$produto['name']}}</span>
                </div>
                <div class="warn"></div>
                <x-input-form title="Código:" class="codadd" name="name" placeholder="Cód" :value="$produto['identification_number']"/>
                <x-input-form title="Nome do produto:" class="nameadd" name="name" placeholder="Nome" :value="$produto['name']"/>
                <x-input-form title="Preço do produto:" class="priceadd" name="name" placeholder="Preço" :value="$produto['price']"/>
                <x-input-form title="Quantidade:" class="qtninitadd" name="name" placeholder="Quantidade" :value="$produto['quantity']"/>
                <button class="default-button-2">Enviar</button>
            </div>
            </div>
        </form>
    </div>

</div>
@endsection
@section('footer')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endsection
