<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\AdminRepositoryInterface;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct(
        private AdminRepositoryInterface $admin
    ) {}

    public function login(Request $request)
    {
        // Verifica se o dados fornecidos são válidos e registra no guard sanctum
        if (Auth::guard('admin')->attempt($request->only(['email', 'password']))) {
            // Pega o id do usuário logado e gera o token
            $admin = Auth::guard('admin')->user();
            $token = $this->admin->createToken($admin->id);

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
