@extends('layouts.inicio')

@section('menu')
<x-menu :user="$user"/>
@endsection

@section('content')
<div class="home-container">
    <div class="dashboard-item sell">
        <h2>Vendas hoje:</h2>
    </div>
    <div class="dashboard-item products">
        <h2>Produtos disponíveis</h2>
    </div>

    <div>

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
              <th>Quantia de itens</th>
              <th>Valor total</th>
            </tr>
            <tr>
              <td>10:30</td>
              <td>N itens</td>
            </tr>
            <tr>
                <td>10:30</td>
                <td>N itens</td>
              </tr>

              <tr>
                <td>10:30</td>
                <td>N itens</td>
              </tr>

              <tr>
                <td>10:30</td>
                <td>N itens</td>
              </tr>

              <tr>
                <td>10:30</td>
                <td>N itens</td>
              </tr>

              <tr>
                <td>10:30</td>
                <td>N itens</td>
              </tr>


              <tr>
                <td>10:30</td>
                <td>N itens</td>
              </tr>

              <tr>
                <td>10:30</td>
                <td>N itens</td>
              </tr>

              <tr>
                <td>10:30</td>
                <td>N itens</td>
              </tr>



          </table>
    </div>

    <div class="dashboard-item graphic-sell">
        <div id="columnchart_values"></div>
    </div>

</div>
</div>
@endsection

@section('footer')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="{{asset('assets/js/dashboard-script.js') }}"></script>
    <script src="{{asset('assets/js/charts.js') }}"></script>
@endsection

