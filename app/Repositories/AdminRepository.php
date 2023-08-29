<?php 

namespace App\Repositories;

use App\Interfaces\AdminRepositoryInterface;
use App\Models\Admin;

class AdminRepository implements AdminRepositoryInterface
{
    public function getAll()
    {
        try {
            return Admin::all();
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function createAdmin($request)
    {
        try {
            Admin::create($request);
            return 'Usuário criado com sucesso';
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function updateAdmin($request, $id)
    {
        try {
            Admin::find($id)->update($request);
            return 'Usuário Alterado com sucesso';
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function deleteAdmin($id)
    {
        try {
            Admin::find($id)->delete();
            return 'Usuário deletado com sucesso';
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function createToken($id)
    {
        try {
            $admin = Admin::find($id);
            $admin->tokens()->delete();
            return $admin->createToken($admin->name)->plainTextToken;
        } catch (\Throwable $th) {
            return $th;
        }
    }
}