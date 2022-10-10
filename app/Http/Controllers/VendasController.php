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
    public function __construct() {
        $this->middleware('auth');
    }

    public function home() {


        return view('vendas', ['user' => Auth::User(), 'data' => $this->listAllVendas()]);
    }

    public function finalizeSale(Request $r) {
        $checkLogin = Auth::User();

        $data = ['made_by' => $checkLogin->id, 'quantity_products' => $r->quantity_products, 'amount'=> $r->amount];
        $newSale = Venda::create($data);

        header('Content-Type: application/json');
        return json_encode($newSale);

    }

    public function insertSoldProduct(Request $r) {
        $user = Auth::User();
        $idProducts = explode(',', $r->produtos);
        //Converter os ids da array para inteiro.
        $mappedIds = array_map(function($s){
            return intval($s);
        },$idProducts);

        $finalData = [];
        $ProdutosVendidos = Produto::findMany($mappedIds);
        foreach($ProdutosVendidos as $produto) {
            $finalData[] =
            [
            'user_id' => $user->id,
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
        $user = Auth::User();
        $vendas = Venda::with(['user:id,name'])->where('made_by', '=', $user->id)->orderBy('created_at', 'desc')->paginate(15);

        return $vendas;
    }
}
