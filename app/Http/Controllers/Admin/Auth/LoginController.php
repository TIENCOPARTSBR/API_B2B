<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Interfaces\AdminRepositoryInterface;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(
        private AdminRepositoryInterface $admin
    ) {}

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (! $token = auth('admin')->attempt($credentials)) {
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
