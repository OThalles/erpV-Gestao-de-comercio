<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LogController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutosController extends Controller
{

    public function home(Request $request) {

        return view('nova-venda', ['user' => Auth::User()]);
    }

    public function products() {
        $checkLogin = auth('sanctum')->user();
        return view('produtos', ['user' => Auth::User(), 'data' => $this->listAllProducts()]);
    }

    private function listAllProducts() {
        $user = Auth::User();
        $produto = Produto::where('user_id', '=', $user->id)->paginate(20);
        return $produto;
    }

    public function editProduct(Request $r){
        $checkLogin = auth('sanctum')->user();
        $produto = Produto::find($r->id);
        return view('edit-product', ['user' => Auth::User(), 'produto' => $produto]);
    }

    public function editAction(Request $r) {
        $produto = Produto::find($r->identification_number);
        $checkLogin = Auth::User();
        $warningLog = 'Editou o produto '.$r->name;

        if(!empty($r->identification_number) && !empty($r->name) && !empty($r->price) && !empty($r->quantity)) {
            $produto->identification_number = $r->identification_number;
            $produto->name = $r->name;
            $produto->price = $r->price;
            $produto->quantity = $r->quantity;
            $produto->save();

            LogController::newLog($warningLog);

            return redirect()->route('products');
        } else {
            session()->put('flash', 'Você precisa preencher todos os campos');
            return redirect()->route('edit-product');
        }
    }

    public function deleteProduct(Request $r){
        $produto = Produto::find($r->id)->delete();
        return redirect()->route('products');

    }

    public function foundProducts(Request $r){
        $checkLogin = Auth::User();
        $id = $r->id;

        if(!empty($id)) {
            $produto = Produto::find($id);
            return view('foundProduct', ['user' => $checkLogin, 'data' => $produto]);
        }
        return redirect()->route('products');
    }

    public function findProduct(Request $request) {
        $produto = Produto::find($request->identification_number);
        header('Content-Type: application/json');
        echo json_encode($produto);
    }
}
