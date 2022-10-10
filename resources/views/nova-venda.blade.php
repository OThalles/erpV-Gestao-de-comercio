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
                <div class="default-button-1"><a href="">Finalizar venda</a></div>
                <div class="default-button-2">Nova Venda</div>
            </div>
        <div class="insert-product">
            @csrf
            <input type="text" class="product-form" name="" id="" placeholder="Insira o código do produto">

        </div>
        <div class="warnerror"></div>
        <div class="warn"></div>
        <div id="modal-finish" class="modal-container">
            <div class="pop-up">
                <p>x</p>
                <span><b>Tem certeza que quer finalizar essa venda?</b></span>
            </div>
        </div>
    </div>
        <div class="table-products">
            <table class="p">
                <tr>
                    <th>Cód</th>
                    <th>Produto</th>
                    <th>Preço</th>
                </tr>


            </table>
        </div>
    </div>
    <div class="final-box">
        <table class="final-new-sale-box">
            <tr>
                <th>Produtos</th>
                <th>Preço final</th>
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

