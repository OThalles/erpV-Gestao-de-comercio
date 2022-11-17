@extends('layouts.default', ['title' => 'Histórico'])

@section('menu')
<x-menu :user="$user"/>
@endsection


@section('content')
<div class="default-container">

    <div class="default-box">
        <div class="secondary-warn" style="margin-bottom: 10px;">Nessa sessão, ficará salvo todas as alterações que um usuário fizer no sistema, exceto as vendas.</div>
            <div class="box-found-items-find">
                <x-border-table routes='found-products' count="{{count($data)}}" :search="False"/>
                <div class="table-products">
                    @if(count($data) > 0)
                    <table class="p">
                        <tr>
                            <th>Usuário</th>
                            <th>Ação</th>
                            <th>Data</th>

                        </tr>

                        @foreach($data as $key => $log)
                        <tr class="normalelement" data-id="{{$key}}">
                            <td>{{$log['user']['name']}}</td>
                            <td>{{$log['action']}}</td>
                            <td>{{$log['created_at']}}</td>

                        </tr>
                        @endforeach
                    </table>
                    @else
                        <table class="p">
                            <th>Atualmente, não existe nenhuma log.</th>
                        </table>
                    @endif


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
<script src="{{asset('assets/js/tables_decoration.js') }}"></script>
@endsection
