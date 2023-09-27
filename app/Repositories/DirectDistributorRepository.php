<?php 

namespace App\Repositories;

use App\Http\Helper;
use App\Interfaces\DirectDistributorInterface;
use App\Models\DirectDistributor;

class DirectDistributorRepository implements DirectDistributorInterface
{
    public function __construct(
        private Helper $helper
    ) {}

    public function getAll()
    {
        try {
            return DirectDistributor::all();
        } catch (\Throwable $th) {
            return $this->helper->http_response_code_500();
        }
    }

    public function getById($id)
    {
        try {
            return DirectDistributor::findOrFail($id);
        } catch (\Throwable $th) {
            return $this->helper->http_response_code_500();
        }
    }

    public function createDirectDistributor($request)
    {
        try {
            DirectDistributor::create($request);
            return $this->helper->http_response_code_200('Distribuidor direto criado com sucesso');
        } catch (\Throwable $th) {
            return $this->helper->http_response_code_500();
        }
    }

    public function updateDirectDistributor($request, $id)
    {
        try {
            DirectDistributor::find($id)->update($request);
            return $this->helper->http_response_code_200('Distribuidor direto alterado com sucesso');
        } catch (\Throwable $th) {
            return $this->helper->http_response_code_500();
        }
    }

    public function deleteDirectDistributor($id)
    {
        try {
            DirectDistributor::find($id)->delete();
            return $this->helper->http_response_code_200('Distribuidor direto deletado com sucesso');
        } catch (\Throwable $th) {
            return $this->helper->http_response_code_500();
        }
    }
}