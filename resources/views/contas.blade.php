@extends('layouts.default', ['title' => 'Contas'])

@section('menu')
<x-menu :user="$user"/>
@endsection


@section('content')
<div class="default-container">

    <div class="default-box">


            <div class="box-found-items-find">
                <x-top-buttons name='Todas as contas' routes='addInvoiceScreen' :button="True" namebuttons='Nova Conta'/>
                <x-border-table routes='found-products' count="{{count($contas)}}" :search="True"/>

                <div class="table-products">
                    <table class="p">
                        @if(count($contas) > 0)
                        <tr>
                            <x-th-tables :th="['Id', 'Aberto por', 'Conta', 'Valor a pagar', 'Status', 'Criado em', '']"/>
                        </tr>
                        <form action="{{route('editstatus')}}" method="POST">
                            @csrf
                        @foreach($contas as $key => $conta)
                        <tr class="normalelement" data-id="{{$key}}">
                            <td>{{$conta['id']}}</td>
                            <td>{{$conta['user']['name']}}</td>
                            <td>{{$conta['name']}}</td>
                            <td id="amount">R$ {{$conta['amount']}}</td>
                            <td> <select class="invoicestatus" name="status[]" id="">
                            <option value="{{$conta['id']}}:0" {{($conta['status'] == 0) ? 'selected':''}}>Não pago</option>
                            <option value="{{$conta['id']}}:1" {{$conta['id']}} {{($conta['status'] == 1) ? 'selected':''}}>Pago</option>

                            </select></td>
                            <td>{{$conta['created_at']}}</td>
                            <td><a href="{{route('deleteinvoice').'/'.$conta['id']}}" style="color:red" onclick="alert('Tem certeza que deseja remover?')">Remover</a></td>
                        </tr>
                        @endforeach
                        @else
                        <tr><th>Não existem contas para serem exibidas.</th></tr>
                        @endif



                    </table>
                    <div class="paginate">

                </div>
            </div>
        </div>
    </div>

    </div>

</div>
@endsection
@section('footer')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{asset('assets/js/invoices.js') }}"></script>
<script src="{{asset('assets/js/tables_decoration.js') }}"></script>
@endsection
