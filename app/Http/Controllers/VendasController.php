<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Venda;
use App\Models\ProdutoVendido;
use App\Models\Produto;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;

class VendasController extends Controller
{
    protected $user;
    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::User();
            return $next($request);
        });

    }

    public function home() {


        return view('vendas', ['user' => Auth::User(), 'data' => $this->listAllVendas()]);
    }

    public function finalizeSale(Request $r) {

        $data = ['made_by' => $this->user->id, 'quantity_products' => $r->quantity_products, 'amount'=> $r->amount];
        $newSale = Venda::create($data);

        header('Content-Type: application/json');
        return json_encode($newSale);

    }

    public function insertSoldProduct(Request $r) {
        $idProducts = explode(',', $r->produtos);
        //Converter os ids da array para inteiro.
        $mappedIds = array_map(function($s){
            return intval($s);
        },$idProducts);

        $finalData = [];
        $ProdutosVendidos = Produto::findMany($mappedIds);

        $updateQt_Vendas = Produto::where('user_id', $this->user->id)->whereIn('id', $mappedIds)->increment('qt_vendas', 1);
        
        $updateQuantity = Produto::where('user_id', $this->user->id)->whereIn('id', $mappedIds)->decrement('quantity', 1);
        foreach($ProdutosVendidos as $produto) {
            $finalData[] =
            [
            'user_id' => $this->user->id,
            'venda_id' => $r->venda_id,
            'produto_id' => $produto['identification_number'],
            'name' => $produto['name'],
            'value' =>$produto['price'],
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime()
            ];

        }
        $createMultiple = ProdutoVendido::insert($finalData);


        return $createMultiple;
    }

    public function detalhesvenda(Request $r) {
        $produtos = ProdutoVendido::where('venda_id', '=', $r->id)->paginate(100);
        $venda = Venda::find($r->id);
        return view('detalhesvenda', ['user' => Auth::User(), 'data' => $produtos, 'venda' => $venda]);
    }

    public function listAllVendas() {
        $vendas = Venda::with(['user:id,name'])->where('made_by', '=', $this->user->id)->orderBy('created_at', 'desc')->paginate(15);

        return $vendas;
    }
}
