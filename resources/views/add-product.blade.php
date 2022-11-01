@extends('layouts.stock-control', ['title' => 'Adicionar novo produto'])

@section('menu')
<x-menu :user="$user"/>
@endsection


@section('content')
<div class="default-container">

    <div class="default-box">

        <div class="alter-product">
            <div class="secondary-warn-container">
                <div class="secondary-warn" style="margin-bottom: 10px;">Certifique-se de que você selecionou a ação correta (Adicionar Produto/Adicionar Estoque).</div>
            </div>
            <div class="box-found-items-add">

                <form class="add-product-form">
                    @csrf
                    <div class="campos-form-container">
                        <div class="campos-form">

                        <div class="editing-top">

                            Adicionando novo produto
                        </div>
                        <div class="warnerror"></div>
                        <div class="warn"></div>
                        @csrf
                        @if ($errors->any())
                        @foreach($errors->all() as $error)
                            <p style="color: #FF0000">{{$error}}</p>
                        @endforeach
                        @endif

                        @if(session('danger'))
                        <span style="color: #FF0000">{{session('danger')}}</span>
                        @endif
                        <x-input-form title="Código do produto: (Apenas números)" class="codadd" name="" placeholder="Código do produto" value='' />
                        <x-button-2 text="Gerar código aleatório"/>
                        <x-input-form title="Nome do produto:" class="nameadd" name="" placeholder="Nome" value=''/>
                        <x-input-form-money title="Preço do produto:" class="priceadd" name="amount" placeholder="Digite o preço" value=''/>
                        <x-input-form title="Quantidade inicial do produto:" class="qtinitadd" name="" placeholder="Quantidade Inicial" value=''/>

                        <button class="default-button-2">Enviar</button>
                    </div>
                    </div>
            </form>
            </div>





        <!--
        <div class="all-products-box">

        </div>
        -->
    </div>

</div>
@endsection

@section('footer')
<script src="https://unpkg.com/imask"></script>
<script src="{{asset('assets/js/products_control_script.js') }}"></script>
@endsection
