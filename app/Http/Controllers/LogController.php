<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function home() {


        return view('log', ['user' => Auth::User(), 'data' => $this->listAllLogs()]);
    }

    private function listAllLogs() {
        $user = Auth::User();
        $log = Log::with(['user:id,name'])->where('user_id', '=', $user->id)->orderBy('created_at', 'desc')->paginate(10);
        return $log;
    }

    public static function newLog($action) {
        $user = Auth::User();
        $log = [
            'user_id' => $user->id,
            'action' => $action
        ];
        $insertLog = Log::create($log);
        return $insertLog;
    }



}
