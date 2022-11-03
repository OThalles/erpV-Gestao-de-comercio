@extends('layouts.default', ['title' => 'Nova Conta'])

@section('menu')
<x-menu :user="$user"/>
@endsection


@section('content')
<div class="default-container">

    <div class="default-box">

        <form class="add-product-form" action="{{route('addInvoice')}}" method="POST">
            @csrf
            <div class="campos-form-container">
                <div class="campos-form">
                <div class="editing-top">

                    Adicionando nova conta
                </div>
                <div class="warn"></div>
                <x-input-form title="Nome da conta:" class="nameadd" name="name" placeholder="Conta á pagar" value='' validation="name" :readonly="False"/>
                <x-input-form-money title="Preço á pagar:" class="priceadd" name="amount" placeholder="Valor" value='' validation="price" :readonly="False"/>

                <button class="default-button-2">Enviar</button>
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
