@extends('layouts.default', ['title' => 'Produtos'])

@section('menu')
<x-menu :user="$user"/>
@endsection


@section('content')
<div class="default-container">

    <div class="default-box">


            <div class="box-found-items-find">


                <div class="warn-container">
                    <div class="warn" style="display: block">Exibindo detalhes da venda N: {{$venda->id}} realizada ás {{$venda->created_at}}</div>
                </div>

                <div class="table-products">
                    <table class="p">
                        <tr>


                            <th>Produto</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                        </tr>

                        @foreach($data as $key => $produto)
                        <tr class="normalelement" data-id="{{$key}}">
                            <td>{{$produto['name']}}</td>
                            <td>{{$produto['value']}}</td>
                            <td>{{$produto['quantity']}}</td>
                        </tr>
                        @endforeach

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
<script src="{{asset('assets/js/table_decoration.js') }}"></script>
@endsection
