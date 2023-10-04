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
        // Verifica se o dados fornecidos são válidos e registra no guard sanctum
        if (Auth::guard('direct-distributor')->attempt($request->only(['email', 'password']))) {
            // Pega o id do usuário logado e gera o token
            $user_data = Auth::guard('direct-distributor')->user();
            $token = $this->user_data->createToken($user_data->id);

            // retorno
            return response()->json([
                'status' => 200,
                'message' => 'Successful login. Welcome!',
                'token' => $token
            ], 200);
        }

        // não autorizado
        return response()->json([
            'status' => 403,
            'message' => 'Username or password does not match.'
        ], 403);
    }
}
