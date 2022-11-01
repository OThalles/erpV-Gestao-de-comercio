<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Produto;

class StockController extends Controller
{

    public function newstock() {

        return view('add-stock', ['user' => Auth::User()]);
    }
    public function newproduct() {

        return view('add-product', ['user' => Auth::User()]);
    }

    public function addStock(Request $r) {
        $quantidade = $r->quantity ? $r->quantity:1;

        $user = Auth::User();
        $product = Produto::where('user_id', '=', $user->id)->where('identification_number', '=', $r->identification_number)->first();
        if($product) {
            $product->quantity = $product->quantity + $quantidade;
            $product->save();
        } else {
        }

        $product = [
            'name' => $product->name,
            'quantity' => $r->quantity
        ];
        $warningLog = 'Adicionou '.$r->quantity.' unidades do produto '.$product->name;
        LogController::newLog($warningLog);


        header('Content-Type: application/json');
        return $product;
    }

    public function addProduct(Request $r) {
        $this->validate($r,[
            'name' => 'required',
            'price' => 'required',
            'identification_number' => 'required',
            'quantity' => 'required'
        ],[
            'name.required' => "É necessário inserir um nome", //Para traduzir o padrao do laravel
            'price.required' =>"É necessário inserir o preço do produto",
            'identification_number' => "É necessário o código do produto",
            'quantity' => "É necessário inserir a quantidade inicial do produto"
        ]);

        $user = Auth::User();
        $data = [
            'user_id' => $user->id,
            'identification_number' => $r->identification_number,
            'name' => $r->name,
            'price' => str_replace(['.',','],['','.'],$r->price),
            'qt_vendas' => 0,
            'quantity' => $r->quantity
    ];
        try {
            $insertProduct = Produto::create($data);
            $warningLog = 'Adicionou o produto '.$r->name.' com '.$r->quantity.' unidades iniciais';
            LogController::newLog($warningLog);
        } catch (Exception $e) {
            echo 'Ocorreu um erro';
        }

        header('Content-Type: application/json');
        return $insertProduct;
    }
}
