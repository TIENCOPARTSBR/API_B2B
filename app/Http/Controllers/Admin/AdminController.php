<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helper;
use App\Interfaces\AdminRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function __construct(
        private AdminRepositoryInterface $admin
    ) {}

    public function store(Request $request) 
    {
        
        //dd(Auth::guard('admin')->user());
       /*  Helper::getUserAdmin($request);

        if (!Gate::allows('admin-access', auth()->user())) {
            abort(403);
        } */

        $admin = $this->admin->createAdmin($request->all());

        return response()->json($admin);
    }
}