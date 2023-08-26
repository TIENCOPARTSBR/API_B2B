<?php

namespace App\Interfaces;

interface AdminRepositoryInterface
{
    public function createAdmin($request);
    public function createToken($token);
}