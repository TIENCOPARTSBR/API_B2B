<?php

namespace App\Http\Controllers\DirectDistributor\Auth;

use App\Http\Controllers\Controller;
use App\Interfaces\DirectDistributorUserDataInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct(
        private DirectDistributorUserDataInterface $user_data
    ) {}

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (! $token = auth('directDistributor')->attempt($credentials)) {
            return response()->json([ // não autorizado
                'status' => 403,
                'message' => 'Username or password does not match.'
            ], 403);
        }

        // retorno
        return response()->json([
            'status' => 200,
            'message' => 'Successful login. Welcome!',
            'token' => $token
        ], 200);
    }
}
