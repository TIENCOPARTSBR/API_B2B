<?php 

namespace App\Repositories;

use App\Http\Helper;
use App\Interfaces\AdminConfigInterface;
use App\Models\AdminConfig;

class AdminConfigRepository implements AdminConfigInterface
{
    public function __construct(
        private Helper $helper
    ) {}

    public function getCostDate()
    {
        try {
            return AdminConfig::findOrFail('2');
        } catch (\Throwable $th) {
            return $this->helper->http_response_code_500();
        }
    }

    public function putCostDate($request)
    {
        try {
            $admin = AdminConfig::findOrFail('2');
            $admin->update($request);
            return $this->helper->http_response_code_200('Configurações atualizadas.');
        } catch (\Throwable $th) {
            return $this->helper->http_response_code_500();
        }
    }

    public function getMailQuotation()
    {
        try {
            return AdminConfig::findOrFail('1');
        } catch (\Throwable $th) {
            return $this->helper->http_response_code_500();
        }
    }

    public function putMailQuotation($request)
    {
        try {
            $admin = AdminConfig::findOrFail('1');
            $admin->update($request);
            return $this->helper->http_response_code_200('Configurações atualizadas.');
        } catch (\Throwable $th) {
            return $this->helper->http_response_code_500();
        }
    }
}