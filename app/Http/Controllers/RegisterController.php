<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function registerApi(Request $request, User $user) {
        $credentials = $request->only('name','email', 'password');
        $credentials['password'] = bcrypt($credentials['password']);
        if(!$user = $user->create($credentials)) {
            abort(500, "Error to create new user");
        }

        return response()->json([
                        'data' => [
                            'user' => $user
                        ]
                        ]);
    }
}
