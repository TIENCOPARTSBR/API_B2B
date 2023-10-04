<?php 

namespace App\Repositories;

use App\Http\Helper;
use App\Interfaces\DirectDistributorUserDataInterface;
use App\Models\DirectDistributorUserData;

class DirectDistributorUserDataRepository implements DirectDistributorUserDataInterface
{
    public function __construct(
        private Helper $helper
    ) {}

    public function getAll()
    {
        try {
            return DirectDistributorUserData::all();
        } catch (\Throwable $th) {
            return $this->helper->http_response_code_500();
        }
    }

    public function getById($id)
    {
        try {
            return DirectDistributorUserData::findOrFail($id);
        } catch (\Throwable $th) {
            return $this->helper->http_response_code_500();
        }
    }

    public function create($request)
    {
        try {
            DirectDistributorUserData::create($request);
            return $this->helper->http_response_code_200('Direct Distributor User Created Successfully.');
        } catch (\Throwable $th) {
            return $this->helper->http_response_code_500();
        }
    }

    public function update($request, $id)
    {
        try {
            DirectDistributorUserData::find($id)->update($request);
            return $this->helper->http_response_code_200('Direct Distributor User Changed Successfully');
        } catch (\Throwable $th) {
            return $this->helper->http_response_code_500();
        }
    }

    public function delete($id)
    {
        try {
            DirectDistributorUserData::find($id)->delete();
            return $this->helper->http_response_code_200('Direct Distributor User Deleted Successfully.');
        } catch (\Throwable $th) {
            return $this->helper->http_response_code_500();
        }
    }

    public function createToken($id)
    {
        try {
            $admin = DirectDistributorUserData::find($id);
            $admin->tokens()->delete();
            return $admin->createToken($admin->name)->plainTextToken;
        } catch (\Throwable $th) {
            return $this->helper->http_response_code_500();
        }
    }

    public function randomToken($id)
    {
        try {
            $randomCode = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
            DirectDistributorUserData::findOrFail($id)->update(['token' => $randomCode]);
            return $randomCode;
        } catch (\Throwable $th) {
            return $this->helper->http_response_code_500();
        }
    }

    public function verifyCode($code)
    {
        try {
            // Faz a consulta no banco de dados se o token existe para algum usuário.
            $admin = DirectDistributorUserData::where('token', $code)->first();
            // Verifica se existe esse código em algum usuário administrador.
            if ($admin) return $this->helper->http_response_code_200('The provided code is valid.', ['id_administrador' => $admin->id]);
            // se não existir o código retornar inválido
            return $this->helper->http_response_code_404('The provided code is invalid.');
        } catch (\Throwable $th) {
            return $this->helper->http_response_code_500();
        }
    }

    public function changePasswordForCode($request)
    {
        try {
            // Verifica se existe esse código em algum usuário administrador.
            $admin = DirectDistributorUserData::find($request['id']);
            
            if ($admin) {
                // Atualizo a senha e zero o token
                $admin->update(['password' => $request['password'], 'token' => '']);
                // Retorno
                return $this->helper->http_response_code_200('Password changed successfully.');
            } 

            // se não existir o usuário retornar inválido
            return $this->helper->http_response_code_404('The password could not be changed.');
        } catch (\Throwable $th) {
            return $this->helper->http_response_code_500();
        }
    }
}