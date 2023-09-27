<?php

namespace App\Interfaces;

interface DirectDistributorInterface
{
    public function getAll();
    public function getById($id);
    public function createDirectDistributor($request);
    public function updateDirectDistributor($request, $id);
    public function deleteDirectDistributor($id);
}