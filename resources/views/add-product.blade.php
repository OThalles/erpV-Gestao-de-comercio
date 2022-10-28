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
                        <div class="warn"></div>
                        <x-input-form title="Código do produto:" class="codadd" name="" placeholder="Código do produto" value='' />
                        <x-input-form title="Nome do produto:" class="nameadd" name="" placeholder="Nome" value=''/>
                        <x-input-form title="Preço do produto:" class="priceadd" name="" placeholder="Preço" value=''/>
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
