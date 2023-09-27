<?php

namespace App\Http\Controllers\DirectDistributor;

use App\Http\Controllers\Controller;
use App\Interfaces\DirectDistributorInterface;
use Illuminate\Http\Request;

class DirectDistributor extends Controller
{
    public function __construct(
        private DirectDistributorInterface $direct_distributor
    ) {}

    public function index()
    {
        return $this->direct_distributor->getAll();
    }

    public function show($id)
    {
        return $this->direct_distributor->getById($id);
    }

    public function store(Request $request) 
    {
        $direct_distributor = $this->direct_distributor->createDirectDistributor($request->all());

        return response()->json($direct_distributor);
    }

    public function update(Request $request, $id)
    {        
        $direct_distributor = $this->direct_distributor->updateDirectDistributor($request->all(), $id);

        return response()->json($direct_distributor);
    }

    public function destroy($id) 
    {
        $direct_distributor = $this->direct_distributor->deleteDirectDistributor($id);

        return response()->json($direct_distributor);
    }
}
