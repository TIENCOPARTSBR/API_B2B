<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
{
    public function handle($request, Closure $next)
    {
        // Defina as origens permitidas aqui
        $allowedOrigins = [
            'http://localhost:3000', // Adicione os domínios que deseja permitir
            // Outras origens permitidas...
        ];

        // Verifique se a origem da solicitação está na lista de origens permitidas
        if (in_array($request->header('Origin'), $allowedOrigins)) {
            // Defina os cabeçalhos permitidos
            $headers = [
                'Access-Control-Allow-Origin' => $request->header('Origin'),
                'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE',
                'Access-Control-Allow-Headers' => 'Content-Type, Authorization',
            ];

            // Verifique se a solicitação é uma solicitação de opções (pré-voo)
            if ($request->isMethod('options')) {
                return response()->json([], 200, $headers);
            }

            // Passe a solicitação para o próximo middleware
            $response = $next($request);

            // Adicione os cabeçalhos CORS à resposta
            foreach ($headers as $key => $value) {
                $response->header($key, $value);
            }

            return $response;
        }

        return $next($request);
    }
}