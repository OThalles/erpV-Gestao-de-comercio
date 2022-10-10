<?php

namespace App\Http\Controllers;

use App\Models\Conta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContasController extends Controller
{
    public function home() {
        return view('contas', ['user' => Auth::User(), 'contas' => $this->listAllContas()]);
    }

    public static function listAllContas() {
        $user = Auth::User();
        $contas = Conta::with(['user:id,name'])->where('user_id', '=', $user->id)->orderBy('created_at', 'desc')->paginate(15);
        return $contas;
    }

    public function delete(Request $r) {
        $conta = Conta::find($r->id)->delete();
        return redirect()->route('invoice');
    }
    public function edit(Request $r) {
        $conta = Conta::find($r->id);
        $conta->status = intval($r->status);
        $conta->save();
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
            'amount' => $r->amount,
            'status' => 0
        ];
        $newInvoice = Conta::create($data);
        return $newInvoice;
    }
}

