<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        if (Auth::attempt($credentials) === false) {
            return response()
                ->json('Unauthorized', 401);
        }
        $user = Auth::user();
        $token = "";
        // creating token
        if ($user instanceof \App\Models\User) {
            $token = $user->createToken('token');
        }
        return response()
            ->json(["token" => $token->plainTextToken]);
    }
}
