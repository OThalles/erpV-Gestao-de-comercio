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
        $user = Auth::User();
        $product = Produto::where('user_id', '=', $user->id)->where('identification_number', '=', $r->identification_number)->first();
        if($product) {
            $product->quantity = $product->quantity + $r->quantity;
            $product->save();
        }
        $warningLog = 'Adicionou '.$r->quantity.' unidades do produto '.$product->name;
        LogController::newLog($warningLog);

        $product = [
            'name' => $product->name,
            'quantity' => $r->quantity
        ];

        header('Content-Type: application/json');
        return $product;
    }

    public function addProduct(Request $r) {
        $user = Auth::User();
        $data = [
            'user_id' => $user->id,
            'identification_number' => $r->identification_number,
            'name' => $r->name,
            'price' => $r->price,
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
