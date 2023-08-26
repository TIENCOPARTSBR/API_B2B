<?php

namespace App\Http;

use Illuminate\Http\Request;

class Helper 
{
    public static function getUserAdmin(Request $request)
    {
        $token = $request->bearerToken();
        $decodedPayload = base64_decode($token);
        $userData = json_decode($decodedPayload);

        dd($userData->sub);
    }
}