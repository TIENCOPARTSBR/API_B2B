<?php

namespace App\Http;

use Illuminate\Http\Request;

class Helper 
{
    public function http_response_code_500()
    {
        return response()->json([
            'status' => 500,
            'message' => 'An error occurred while processing your request.'
        ], 500);
    }
    
    public function http_response_code_200($message, $custom = NULL)
    {
        $response = [
            'status' => 200,
            'message' => $message,
        ];

        if ($custom) $response = array_merge($response, $custom);

        return response()->json($response, 200);
    }

    public function http_response_code_404($message, $custom = NULL)
    {
        $response = [
            'status' => 404,
            'message' => $message,
        ];

        if ($custom) $response = array_merge($response, $custom);

        return response()->json($response, 404);
    }
}