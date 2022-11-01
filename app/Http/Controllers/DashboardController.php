<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Venda;
use App\Models\Produto;
use App\Models\ProdutoVendido;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
            'vendasMonth' => $this->getCountVendasMonth(),
            'AllStock' => $this->getAllStock()
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

    private function getCountVendasMonth() {
        $actualMonth = date('m');
        $vendasMonth = Venda::where('made_by', '=', $this->user->id)->whereMonth('created_at', '=', $actualMonth)->get();
        return $vendasMonth;
    }

    public function LastDaysVendas(Request $r) {
        $array = [];
        $days = [];
        $hj = date('Y-m-d');
        $lastDaysDate = date('Y-m-d', strtotime("-30 days", strtotime($hj)));
        $todayDate = date('Y-m-d', strtotime("+1 days", strtotime($hj)));
        $venda = ProdutoVendido::where('user_id', '=', $this->user->id)->whereBetween('created_at', [
            $lastDaysDate,
            $todayDate])
            ->get();

        // foreach($venda as $items) {
        //     $days[] =
        //         \Carbon\Carbon::parse($items->created_at)->format('d');

        // }

        //$produto = DB::select(DB::raw("SELECT created_at, COUNT(*) FROM produto_vendidos GROUP BY DAY(created_at)"));
        $produtodois = DB::table('produto_vendidos as w')
                            ->select(array(DB::raw('sum(quantity) as Day_count'),DB::raw('DATE(w.created_at) day')))
                            ->groupBy('day')
                            ->orderBy('w.created_at')
                            ->get();
        return json_encode($produtodois);
    }

    private function getProductsAvailable() {
        $produto = Produto::all()->count();
        return $produto;
    }

    private function getAllStock() {
        $produto = Produto::all()->sum('quantity');
        return $produto;
    }

    public function getBestSellers() {
        $bestsellers = Produto::where('user_id', '=', $this->user->id)->where('qt_vendas', '>', 0)->orderBy('qt_vendas','desc')->take(10)->get();
        return json_encode($bestsellers);
    }
}
