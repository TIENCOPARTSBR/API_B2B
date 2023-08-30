<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\AdminRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function __construct(
        private AdminRepositoryInterface $admin
    ) {}

    public function index()
    {
        return $this->admin->getAll();
    }

    public function store(Request $request) 
    {
        $admin = $this->admin->createAdmin($request->all());

        return response()->json($admin);
    }

    public function update(Request $request, $id)
    {        
        $admin = $this->admin->updateAdmin($request->all(), $id);

        return response()->json($admin);
    }

    public function destroy($id) 
    {
        if (!Gate::allows('admin-access', auth('sanctum')->user())) abort(403); 

        $admin = $this->admin->deleteAdmin($id);

        return response()->json($admin);
    }
}-