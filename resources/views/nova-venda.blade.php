@extends('layouts.default', ['title' => 'Nova venda'])


@section('menu')
    <x-menu :user="$user"/>
@endsection

@section('top-menu')
    <x-top-menu></x-top-menu>
@endsection


@section('content')
<div class="nova-venda-container">
    <div class="box-nova-venda">
        <div class="container-insert">
            <div class="top-buttons">
                <div class="default-button-2">Finalizar Venda</div>
            </div>

        <div class="insert-product">
            @csrf
        </div>
        <x-warns/>
        <x-modal/>
    </div>
    <div class="campos-search">
        <div class="search-container">

                <input type="text" class="product-form" name="" id="" placeholder="Insira o código do produto">
                </a>


            </div>
        </div>
        <div class="table-products nova-venda">
            <table class="p">
                <tr>
                    <th >Cód</th>
                    <th >Produto</th>
                    <th >Preço</th>
                </tr>


            </table>
        </div>
    </div>
    <div class="final-box">
        <table class="final-new-sale-box">
            <tr>
                <th>Produtos</th>
                <th>Valor Total</th>
            </tr>
            <tr>
                <td class="count-product">0</td>
                <td class="total-price">0.00</td>
            </tr>
        </table>
    </div>
</div>
@endsection

@section('footer')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{asset('assets/js/ajax_jquery.js') }}"></script>
@endsection

