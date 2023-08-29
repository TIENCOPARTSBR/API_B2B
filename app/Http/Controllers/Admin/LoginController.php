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
        $credentials = $request->only(['email', 'password']);

        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();
            $token = $this->admin->createToken($admin->id);
            return response()->json($token, 200);
        }

        return response()->json(['Unauthorized'], 401);
    }

    public function recoverPassword(Request $request) 
    {
        dd($request);
    }
}
