<?php

namespace App\Http\Controllers\DirectDistributor;

use App\Http\Controllers\Controller;
use App\Models\DirectDistributorUserData;
use Illuminate\Http\Request;

class UserData extends Controller
{
    public function __construct(
        private DirectDistributorUserData $user_data
    ) {}

    public function index()
    {
        return $this->user_data->getAll();
    }

    public function show($id)
    {
        return $this->user_data->getById($id);
    }

    public function store(Request $request) 
    {
        $user_data = $this->user_data->create($request->all());

        return response()->json($user_data);
    }

    public function update(Request $request, $id)
    {        
        $user_data = $this->user_data->update($request->all(), $id);

        return response()->json($user_data);
    }

    public function destroy($id) 
    {
        $user_data = $this->user_data->delete($id);

        return response()->json($user_data);
    }
}
