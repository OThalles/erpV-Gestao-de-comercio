@extends('layouts.default', ['title' => 'Produtos'])

@section('menu')
<x-menu :user="$user"/>
@endsection


@section('content')
<div class="default-container">

    <div class="default-box">
            <div class="box-found-items-find">
                <x-top-buttons tonga='Todos os produtos' routes='addproduct' namebuttons='Novo produto'/>
                <x-border-table routes='found-products' count="{{count($data)}}"/>

                    {{-- <div class="campos-search">
                        <div class="search-container">
                            <form action="{{route('found-products')}}" method="GET">
                                <div class="search-bar">
                                <input type="text" class="product-form" name="id" autocomplete="off" id="" placeholder="Pesquisar pelo código">
                                <a href="" class="search-btn">

                                    <img  class="loupe-white" src="{{asset('assets/icons/loupe-white.svg')}}" alt="">
                                </a>
                                </div>
                                </form>
                            </div>
                        </div> --}}
                    <div class="table-products">
                        <table class="p">
                            <tr>
                                <x-th-tables :th="['Código', 'Produto', 'Preço', 'Quantidade', 'Ação']"/>
                            </tr>

                            @foreach($data as $key => $produto)
                            <tr class="normalelement" data-id="{{$key}}">
                                <td>{{$produto['identification_number']}}</td>
                                <td>{{$produto['name']}}</td>
                                <td>{{$produto['price']}}</td>
                                <td>{{$produto['quantity']}}</td>
                                <td>
                                    <a  href="{{url('products/edit-product').'/'.$produto['identification_number']}}" style="color:green">Alterar</a>
                                    <a href="{{url('products/delete-product').'/'.$produto['identification_number']}}" style="color:red">Remover</a>
                                </td>
                            </tr>
                            @endforeach

                        </table>
                        <div class="paginate">
                            <div>{{$data->links()}}</div>
                        </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{asset('assets/js/find_products_ajax.js') }}"></script>
<script src="{{asset('assets/js/table_decoration.js') }}"></script>
@endsection
