<?php

namespace App\Http\Controllers;

use App\Models\Conta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContasController extends Controller
{
    protected $user;
    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::User();
            return $next($request);
        });

    }

    public function home() {
        return view('contas', ['user' => Auth::User(), 'contas' => $this->listAllContas()]);
    }

    public function listAllContas() {
        $contas = Conta::with(['user:id,name'])->where('user_id', '=', $this->user->id)->orderBy('created_at', 'desc')->paginate(15);
        return $contas;
    }

    public function delete(Request $r) {
        $conta = Conta::where('user_id',$this->user->id)->where('id',$r->id)->delete();
        return redirect()->route('invoice');
    }
    public function edit(Request $r) {
        $conta = Conta::where('user_id',$this->user->id)->where('id',$r->id)->update(
            ['status' => intval($r->status)]
        );

        return json_encode($conta);
    }

    public function add(Request $r) {
        return view('new-invoice', ['user' => Auth::User()]);
    }

    public function addAction(request $r) {
        $user = Auth::User();
        $data = [
            'user_id' => $user->id,
            'name' => $r->name,
            'amount' => str_replace(['.',','],['','.'],$r->amount),
            'status' => 0
        ];
        $newInvoice = Conta::create($data);
        return redirect()->route('invoice');
    }

    public function foundInvoice(Request $r) {
        
    }
}

