<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Produto;
use Illuminate\Validation\Rule;
use Image;

class StockController extends Controller
{
    protected $user;
    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::User();
            return $next($request);
        });

    }

    public function newstock() {

        return view('add-stock', ['user' => Auth::User()]);
    }
    public function newproduct() {

        return view('add-product', ['user' => Auth::User()]);
    }

    public function addStock(Request $r) {
        $quantidade = $r->quantity ? $r->quantity:1;
        $response = [];

        $user = Auth::User();

        $this->validate($r,[
            'identification_number' => 'integer|exists:produtos|required',
        ],[
            'identification_number.exists' => "Você ainda não cadastrou esse produto",
            'identification_number.required' => "É necessario inserir o código do produto",
            'identification_number.integer' => "O código do produto tem que ser numérico",
        ]);

        $product = Produto::where('user_id', '=', $user->id)->where('identification_number', '=', $r->identification_number)->first();
        if($product) {
            $product->quantity = $product->quantity + $quantidade;
            $product->save();
        }

        $warningLog = 'Adicionou '.$quantidade.' unidades do produto '.$product->name;
        LogController::newLog($warningLog);

        $product['quantity'] = $quantidade;

        header('Content-Type: application/json');
        return $product;
    }

    public function addProduct(Request $r) {
        $user = Auth::User();
        $this->validate($r,[
            'name' => 'required|min:1|max:255',
            'image' => 'mimes:jpeg,png,jpg:max:2048',
            'price' => 'required',
            'identification_number' => [Rule::unique('produtos')->where(function($query){
                $query->where('user_id', Auth::User()->id);
            }), 'required', 'max:255'],
            'quantity' => 'required|numeric'
        ],[
            'name.required' => "É necessário inserir um nome", //Para traduzir o padrao do laravel
            'name.min' => "O nome precisa ter mais de um caractere",
            'name.max' => "O nome é muito grande",
            'price.required' =>"É necessário inserir o preço do produto",
            'identification_number.unique' => "Você já adicionou esse produto anteriormente",
            'identification_number.required' => "É necessario inserir o código do produto",
            'identification_number.numeric' => "O código do produto deve conter apenas números",
            'identification_number.max' => "O código do produto tem muitos caracteres (max: 255)",
            'quantity.required' => "É necessário inserir a quantidade inicial do produto",
            'quantity.numeric' => "A quantidade deve ser um valor numérico"
        ]);
        if($r->hasFile('image') && $r->file('image')->isValid()) {
            $requestImage = $r->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . '.' .$extension;
            $imgresize = Image::make($requestImage->getRealPath());
            $imgresize->resize(300,300);
            $imgresize->save(public_path('assets/img/products/'. $imageName));

        }


        $data = [
            'user_id' => $user->id,
            'identification_number' => $r->identification_number,
            'name' => $r->name,
            'price' => str_replace(['.',','],['','.'],$r->price),
            'photo' => $imageName,
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
