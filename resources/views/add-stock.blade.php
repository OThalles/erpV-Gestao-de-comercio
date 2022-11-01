@extends('layouts.stock-control', ['title' => 'Adicionar estoque'])

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

                <div class="warnstk"></div>
            <div class="add-quantity">
                <div class="add-stock-box">
                <form class="add-stock-form">
                    @csrf
                    <div class="campos-form-container">
                        <div class="campos-form">
                        <div class="editing-top">

                            Adicionando estoque
                        </div>
                        <x-warns/>
                        <x-input-form title="Código do produto: (Apenas números)" class="codadd-stock" name="" placeholder="Código do produto" value='' />
                        <x-input-form title="Quantidade (Caso não preenchido será aumentado em 1):" class="qtinitadd-stock" name="" placeholder="Quantidade Inicial" value=''/>

                        <button class="default-button-2">Enviar</button>
                    </div>
                    </div>

                </form>
                </div>
            </div>

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
<script src="{{asset('assets/js/stock_control_ajax.js') }}"></script>
@endsection
