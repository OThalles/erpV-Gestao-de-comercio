@extends('layouts.inicio')

@section('menu')
<x-menu :user="$user"/>
@endsection

@section('content')
<div class="home-container">
    <div class="dashboard-container"></div>
    <div class="dashboard-item sell">
        <h2>Vendas hoje:</h2>
        <h3>{{$vendastoday}}</h3>
        <h2>Itens Vendidos:</h2>
        <h3>34</h3>
    </div>
    <div class="dashboard-item products">
        <h2>Produtos Disponíveis</h2>
        <h3>{{$productsAvailable}}</h3>
            <h3>{{$vendasMonth}}</h3>

    </div>

    <div>

    </div>
    <div class="dashboard-item bestsellers">
        <div class="filters_graphics">

    </div>
        <div class="graphic-vendas-area">
            <canvas id="myChart"></canvas>
        </div>


    </div>
    <div class="dashboard-item historic-sell">
        <div class="title-last-sales">
            <h2>Histórico de vendas</h2>
            <hr class="division-last-sales">
            <span>Registro das suas ultimas 13 vendas</span>
        </div>
        <table class="table-historic-sells">
            <tr>
              <th>Horário</th>
              <th>Cliente</th>
              <th>Quantia de itens</th>
              <th>Valor total</th>
            </tr>
            @foreach($vendaslast as $last)
            <tr>
              <td>{{$last['created_at']}}</td>
              <td>{{$last['client']}}</td>
              <td>{{$last['quantity_products']}}</td>
              <td>{{$last['amount']}}</td>
            </tr>
            @endforeach




          </table>
    </div>

    <div class="dashboard-item graphic-sell">
        <canvas id="myChartbestsellers"></canvas>
    </div>

</div>
</div>
@endsection

@section('footer')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{asset('assets/js/dashboard-script.js') }}"></script>
    <script src="{{asset('assets/js/charts.js') }}"></script>
@endsection

