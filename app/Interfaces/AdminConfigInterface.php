<?php

namespace App\Interfaces;

interface AdminConfigInterface
{
    public function getCostDate();
    public function putCostDate($request);
    public function getMailQuotation();
    public function putMailQuotation($request);
}