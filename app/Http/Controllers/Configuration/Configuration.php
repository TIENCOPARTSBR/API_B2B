<?php

namespace App\Http\Controllers\Configuration;

use App\Http\Controllers\Controller;
use App\Interfaces\AdminConfigInterface;
use Illuminate\Http\Request;

class Configuration extends Controller
{
    public function __construct(
        private AdminConfigInterface $config
    ) {}

    public function getCostDate()
    {
        return $this->config->getCostDate();
    }

    public function putCostDate(Request $request) 
    {
        $config = $this->config->putCostDate($request->all());

        return response()->json($config);
    }

    public function getMailQuotation()
    {
        return $this->config->getMailQuotation();
    }

    public function putMailQuotation(Request $request) 
    {
        $config = $this->config->putMailQuotation($request->all());

        return response()->json($config);
    }
}
