<?php

namespace App\Interfaces;

interface AdminRepositoryInterface
{
    public function getAll();
    public function createAdmin($request);
    public function updateAdmin($request, $id);
    public function createToken($token);
    public function deleteAdmin($id);
    public function randomToken($id);
    public function verifyCode($code);
    public function changePasswordForCode($request);
}