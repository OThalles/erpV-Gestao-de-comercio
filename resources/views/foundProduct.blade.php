@extends('layouts.default', ['title' => 'Produto: '.$data['name']])

@section('menu')
<x-menu :user="$user"/>
@endsection


@section('content')
<div class="default-container">

    <div class="default-box">


            <div class="box-found-items-find">
                <div class="campos-product">
                    <form action="{{route('found-products')}}" method="GET">
                    <input type="text" class="product-form" name="id" id="" placeholder="Insira o código ou nome do produto">
                    </form>
                </div>
                <div class="table-products">
                    <table class="p">
                        <tr>
                            <th>Cód</th>
                            <th>Produto</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Ação</th>
                        </tr>


                        <tr>
                            <td>{{$data['identification_number']}}</td>
                            <td>{{$data['name']}}</td>
                            <td>{{$data['price']}}</td>
                            <td>{{$data['quantity']}}</td>
                            <td>
                                <a  href="{{url('products/edit-product').'/'.$data['identification_number']}}" style="color:green">Alterar</a>
                                <a href="{{url('nova-venda')}}" style="color:red">Remover</a>
                            </td>
                        </tr>

                    </table>


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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{asset('assets/js/find_products_ajax.js') }}"></script>
@endsection
