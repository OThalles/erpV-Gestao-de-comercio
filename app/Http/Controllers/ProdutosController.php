<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LogController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Produto;
use Illuminate\Validation\Rule;


class ProdutosController extends Controller
{
    protected $user;
    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::User();
            return $next($request);
        });

    }

    public function home(Request $request) {

        return view('nova-venda', ['user' => $this->user]);
    }

    public function products() {
        return view('produtos', ['user' => $this->user, 'data' => $this->listAllProducts()]);
    }

    private function listAllProducts() {
        $produto = Produto::where('user_id', '=', $this->user->id)->orderBy('created_at','desc')->paginate(20);
        return $produto;
    }

    public function editProduct(Request $r){

        $produto = Produto::where('user_id', $this->user->id)->where('identification_number',$r->id)->first();
        return view('edit-product', ['user' => $this->user, 'produto' => $produto]);
    }

    public function editAction(Request $r) {
        $checkLogin = Auth::User();
        $warningLog = 'Editou o produto '.$r->name;


        $this->validate($r,[
            'name' => 'required|min:1|max:255',
            'price' => 'required',

            'quantity' => 'required|numeric'
        ],[
            'name.required' => "É necessário inserir um nome", //Para traduzir o padrao do laravel
            'name.min' => "O nome precisa ter mais de um caractere",
            'name.max' => "O nome é muito grande",
            'price.required' =>"É necessário inserir o preço do produto",
            'quantity.required' => "É necessário inserir a quantidade inicial do produto",
            'quantity.numeric' => "A quantidade deve ser um valor numérico"
        ]);

        if(!empty($r->name) && !empty($r->price) && !empty($r->quantity)) {
            Produto::where('user_id', $this->user->id)->where('identification_number',$r->identification_number)->update(
                [
                 'name' => $r->name,
                 'price' => str_replace(['.',','],['','.'],$r->price),
                 'quantity' => $r->quantity
                ]
                );

            LogController::newLog($warningLog);

            return redirect()->route('products');
        } else {
            session()->put('flash', 'Você precisa preencher todos os campos');
            return redirect()->route('edit-product');
        }
    }

    public function deleteProduct(Request $r){
        $produto = Produto::where('user_id', $this->user->id)->where('identification_number',$r->id)->delete();
        return redirect()->route('products');

    }

    public function foundProducts(Request $r){
        $checkLogin = Auth::User();
        $id = $r->id;

        if(!empty($id)) {
            $produto = Produto::where('user_id', $this->user->id)->where('identification_number',$r->id)->first();
            return view('foundProduct', ['user' => $checkLogin, 'data' => $produto]);
        }
        return redirect()->route('products');
    }

    public function findProduct(Request $request) {
        $produto = Produto::where('user_id', Auth::User()->id)->where('identification_number',$request->identification_number)->first();
        header('Content-Type: application/json');
        echo json_encode($produto);
    }
}
