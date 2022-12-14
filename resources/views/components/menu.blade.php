<div class="menu-container">
    <div class="menu">
        <div class="menu-options">

        <ul>
            <li class="mobile-menu">Mostrar menu de seleções</li>
            <div class="logged-user">

                <a href="">
                <img src="" alt=""><span>Conectado Como {{$user->name}}</span>
                </a>
        </div>
            <a href="{{url('/')}}">
                <li class="{{ (request()->is('/')) ? 'active' : '' }}">
                    <img src="{{asset('assets/icons/dashboard.png')}}" alt=""> <span>Dashboard</span>
                </li>
            </a>
            <a href="{{url('nova-venda')}}">
                <li class="{{ (request()->is('nova-venda')) ? 'active' : '' }}">
                    <img src="{{asset('assets/icons/shop_icon.png')}}" alt=""> <span>Frente de Caixa</span>
                </li>
            </a>

                <li class="stock-control {{ (request()->is('stock-control')) ? 'active' : '' }}">
                    <img src="{{asset('assets/icons/stock-control-icon.png')}}" alt=""> <span>Controle de estoque</span>
                </li>
                <a href="{{url('products/add-product')}}" class="submenu addproduct stock hidden" style="background-color: #fff;">
                    <li class="{{ (request()->is('stock-control')) ? 'active' : '' }}">
                         <span>Adicionar Produto</span>
                    </li></a>
                    <a href="{{url('products/add-stock')}}" class="submenu addstock stock hidden">
                        <li class="{{ (request()->is('stock-control')) ? 'active' : '' }}">
                         <span>Adicionar Estoque</span>
                        </li></a>
            <a href="{{url('products')}}">
                <li class="{{ (request()->is('products')) ? 'active' : '' }}">
                    <img src="{{asset('assets/icons/products.png')}}" alt=""> <span>Produtos</span>
                </li></a>
            <a href="{{url('contas')}}">
                <li class="{{ (request()->is('relatorios')) ? 'active' : '' }}">
                    <img src="{{asset('assets/icons/invoice.png')}}" alt=""> <span>Contas</span>
                </li>
            </a>
            <a href="{{url('log')}}">
                <li class="{{ (request()->is('log')) ? 'active' : '' }}">
                    <img src="{{asset('assets/icons/historical.png')}}" alt=""> <span>Histórico</span>
                </li>
            </a>
            <a href="{{url('vendas')}}">
                <li class="{{ (request()->is('vendas')) ? 'active' : '' }}">
                    <img src="{{asset('assets/icons/sales.png')}}" alt=""> <span>Vendas</span>
                </li>
            </a>
            <a href="{{route('logout')}}">
                <li> <img src="{{asset('assets/icons/logout.png')}}" alt=""> <span>Sair</span></li>
            </a>

        </ul>
        </div>
    </div>
</div>

<script src="{{asset('assets/js/menu-script.js') }}"></script>
