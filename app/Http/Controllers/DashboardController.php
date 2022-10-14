<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Venda;
use App\Models\Produto;

class DashboardController extends Controller
{
    protected $user;
    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::User();
            return $next($request);
        });

    }

    public function home() {

        return view('inicio', [
            'menu' => 'inicio',
            'user' => Auth::User(),
            'vendastoday' => $this->getVendasToday(),
            'vendaslast' => $this->getVendasLast(),
            'productsAvailable' => $this->getProductsAvailable(),
            'bestSellers' => $this->getBestSellers(),
            'vendasMonth' => $this->getVendasMonth()
        ]);
    }

    private function getVendasToday() {
        $today = new \DateTime('today');
        $venda = Venda::where('created_at', 'LIKE', '%'.$today->format('Y/m/d').'%')->get()->count();
        return $venda;
    }

    private function getVendasLast() {

        $venda = Venda::where('made_by', '=', $this->user->id)->orderBy('created_at','desc')->take(13)->get();
        return $venda;
    }

    private function getVendasMonth() {
        $actualMonth = date('m');
        $vendasMonth = Venda::where('made_by', '=', $this->user->id)->whereMonth('created_at', '=', $actualMonth)->count();
        return $vendasMonth;
    }

    private function getProductsAvailable() {
        $produto = Produto::all()->count();
        return $produto;
    }

    public function getBestSellers() {
        $bestsellers = Produto::where('user_id', '=', $this->user->id)->where('qt_vendas', '>', 0)->orderBy('qt_vendas','desc')->take(10)->get();
        return json_encode($bestsellers);
    }
}
