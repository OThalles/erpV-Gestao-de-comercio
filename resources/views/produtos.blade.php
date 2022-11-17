@extends('layouts.default', ['title' => 'Produtos'])

@section('menu')
<x-menu :user="$user"/>
@endsection


@section('content')
<div class="default-container">

    <div class="default-box">
            <div class="box-found-items-find">
                <x-top-buttons name='Todos os produtos' :button="True" routes='addproduct' namebuttons='Novo produto'/>
                <x-border-table routes='found-products' count="{{count($data)}}" :search="True"/>
                
                    <div class="table-products">
                        <table class="p">
                            <tr>
                                <x-th-tables :th="['Código', 'Foto','Produto', 'Preço', 'Quantidade', 'Ação']"/>
                            </tr>

                            @foreach($data as $key => $produto)
                            <tr class="normalelement" data-id="{{$key}}">
                                <td>{{$produto['identification_number']}}</td>
                                <td><img src="{{asset('assets/img/products/'.$produto['photo'])}}" width="85px" height="85px" alt="isso"></td>
                                <td>{{$produto['name']}}</td>
                                <td>R$ {{$produto['price']}}</td>
                                <td>{{$produto['quantity']}}</td>
                                <td class="actions">
                                    <div class="actions-container">
                                    <a  href="{{url('products/edit-product').'/'.$produto['identification_number']}}" style="color:green">
                                        <div class="circle edit">
                                            <img title="Editar" src="{{asset('assets/icons/edit.png')}}" class="icon-action" alt="Editar">
                                        </div>
                                    </a>
                                    <a href="{{url('products/delete-product').'/'.$produto['identification_number']}}" style="color:red">
                                        <div class="circle remove">
                                            <img title="Remover" src="{{asset('assets/icons/trash.png')}}" class="icon-action" alt="Remover">
                                        </div>
                                     </a>
                                </div>
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

    </div>

</div>
@endsection
@section('footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{asset('assets/js/find_products_ajax.js') }}"></script>
<script src="{{asset('assets/js/tables_decoration.js') }}"></script>
@endsection
