@extends('layouts.default', ['title' => 'Vendas'])

@section('menu')
<x-menu :user="$user"/>
@endsection


@section('content')
<div class="default-container">

    <div class="default-box">


            <div class="box-found-items-find">
                <x-top-buttons name='Vendas' routes='addproduct' :button="False" namebuttons='Novo produto'/>
                <x-border-table routes='found-products' count="{{count($data)}}" :search="False"/>
                <div class="table-products">
                    <table class="p">
                        @if(count($data) > 0)
                        <tr>
                            <th>Id</th>
                            <th>Usuário</th>
                            <th>Cliente</th>
                            <th>Valor total</th>
                            <th>Quantidade de produtos</th>
                            <th>Data</th>
                            <th>Ação</th>

                        </tr>

                        @foreach($data as $key => $venda)
                        <tr class="normalelement" data-id="{{$key}}">
                            <td>{{$venda['id']}}</td>
                            <td>{{$venda['user']['name']}}</td>
                            <td>{{$venda['client']}}</td>
                            <td>{{$venda['amount']}}</td>
                            <td>{{$venda['quantity_products']}}</td>
                            <td>{{$venda['created_at']}}</td>
                            <td><a href="{{route('detalhesvenda').'/'.$venda['id']}}" style="color:green">Ver itens</a></td>

                        </tr>
                        @endforeach
                        @else
                        <table class="p">
                            <th>Atualmente, não existe nenhum registro de venda.</th>
                        </table>
                        @endif

                    </table>


            </div>
            <div class="paginate">
                <div>{{$data->links()}}</div>
            </div>
        </div>

    </div>

</div>
@endsection
@section('footer')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{asset('assets/js/find_products_ajax.js') }}"></script>
<script src="{{asset('assets/js/tables_decoration.js') }}"></script>
@endsection
