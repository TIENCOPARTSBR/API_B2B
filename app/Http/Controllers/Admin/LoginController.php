<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // login
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();
            $admin = Admin::find($admin->id);
            //$admin->tokens()->delete();
            $token = $admin->createToken($admin->name)->plainTextToken;
        
            return response()->json($token, 200);
        }

        return response()->json(['Unauthorized'], 401);
    }
}
