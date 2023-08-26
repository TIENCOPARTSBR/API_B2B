<?php 

namespace App\Repositories;

use App\Interfaces\AdminRepositoryInterface;
use App\Models\Admin;

class AdminRepository implements AdminRepositoryInterface
{
    public function createAdmin($request)
    {
        try {
            Admin::create($request);
            return 'Usuário criado com sucesso';
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function createToken($token)
    {

    }
}