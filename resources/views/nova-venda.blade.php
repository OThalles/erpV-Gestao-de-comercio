@extends('layouts.default', ['title' => 'Nova venda'])


@section('menu')
    <x-menu :user="$user"/>
@endsection



@section('content')
<div class="nova-venda-container">
    <div class="top-buttons">
        <div class="default-button-2">Finalizar Venda</div>
    </div>
    <div class="box-nova-venda">
        <div class="container-insert">

        <div class="insert-product">
            @csrf
        </div>
        <x-modal/>
    </div>
    <div class="campos-search">
        <div class="search-container">

                <input type="text" class="product-form" name="" id="" placeholder="Insira o código do produto">



            </div>
        </div>
        <div class="table-products nova-venda">
            <div class="product-info-box">
                <div class="product-photo product-info-style">
                    <img id="img-product" src="" alt="">
                </div>
                <div class="product-name product-info-style" id="product-name">
                    Nome:
                    <p class="name_infotext" id="name_infotext"></p>
                </div>
                <div class="product-price product-info-style" id="product-price">
                    Preço:
                    <p class="price_infotext" id="price_infotext"></p>
                </div>
            </div>
            <div class="container-table">
            <table class="p">
                <tr>
                    <x-th-tables :th="['Código', 'Produto','Preço', 'Ação']"/>
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
</div>
@endsection

@section('footer')

    <script type="text/javascript">
    var publicUrl = '{{asset("/assets/img/products")}}'
    var iconRemove = "{{asset('assets/icons/trash.png')}}"
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{asset('assets/js/ajax_jquery.js') }}"></script>
@endsection

