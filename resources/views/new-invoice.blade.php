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
                <x-input-form title="Nome da conta:" class="amountadd" name="amount" placeholder="Conta á pagar" value='' />
                <x-input-form title="Código:" class="nameadd" name="name" placeholder="Cód" value=''/>

                <button class="default-button-2">Enviar</button>
            </div>
            </div>
        </form>
    </div>

</div>
@endsection
@section('footer')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{asset('assets/js/find_products_ajax.js') }}"></script>
@endsection