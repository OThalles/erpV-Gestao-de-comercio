@extends('layouts.default', ['title' => 'Contas'])

@section('menu')
<x-menu :user="$user"/>
@endsection


@section('content')
<div class="default-container">

    <div class="default-box">


            <div class="box-found-items-find">

                <div class="secondary-warn">Nessa sessão, você pode administrar as contas do estabelecimento</div>

                <div class="campos-search">
                    <div class="search-container">
                    <form action="{{route('found-products')}}" method="GET">
                    <div class="search-bar">
                    <input type="text" class="product-form" name="id" autocomplete="off" id="" placeholder="Insira o código ou nome do produto">
                    </div>
                    </form>
                </div>
                </div>
                <div class="table-products">
                    <table class="p">
                        @if(count($contas) > 0)
                        <tr>
                            <th>Id</th>
                            <th>Aberto por</th>
                            <th>Conta</th>
                            <th>Valor á pagar</th>
                            <th>Status</th>
                            <th>Criado em</th>
                            <th></th>
                        </tr>
                        <form action="{{route('editstatus')}}" method="POST">
                            @csrf
                        @foreach($contas as $key => $conta)
                        <tr class="normalelement" data-id="{{$key}}">
                            <td>{{$conta['id']}}</td>
                            <td>{{$conta['user']['name']}}</td>
                            <td>{{$conta['name']}}</td>
                            <td>{{$conta['amount']}}</td>
                            <td> <select class="invoicestatus" name="status[]" id="">
                            <option value="{{$conta['id']}}:0" {{($conta['status'] == 0) ? 'selected':''}}>Não pago</option>
                            <option value="{{$conta['id']}}:1" {{$conta['id']}} {{($conta['status'] == 1) ? 'selected':''}}>Pago</option>

                            </select></td>
                            <td>08/12/2002</td>
                            <td><a href="{{route('deleteinvoice').'/'.$conta['id']}}" style="color:red" onclick="alert('Tem certeza que deseja remover?')">Remover</a></td>
                        </tr>
                        @endforeach
                        @else
                        <tr><th>Não existem contas para serem exibidas.</th></tr>
                        @endif



                    </table>

                    <div class="container-options">
                    <a style="width: 80%" href="{{route('addInvoiceScreen')}}"><div class="default-button-2">Adicionar nova conta á pagar</div></a>
                    </form>
                    </div>
            </div>
            <div class="paginate">

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
<script src="{{asset('assets/js/invoices.js') }}"></script>
<script src="{{asset('assets/js/tables_decoration.js') }}"></script>
@endsection
