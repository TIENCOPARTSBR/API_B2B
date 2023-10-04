<?php

namespace App\Interfaces;

interface DirectDistributorUserDataInterface
{
    public function getAll();
    public function getById($id);
    public function create($request);
    public function update($request, $id);
    public function delete($id);
    public function createToken($token);
    public function randomToken($id);
    public function verifyCode($code);
    public function changePasswordForCode($request);
}