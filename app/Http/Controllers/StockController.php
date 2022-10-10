<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Produto;

class StockController extends Controller
{

    public function stock() {

        return view('stock-control', ['user' => Auth::User()]);
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
            'quantity' => $r->quantity
    ];

        $insertProduct = Produto::create($data);
        header('Content-Type: application/json');
        return $insertProduct;
    }
}
