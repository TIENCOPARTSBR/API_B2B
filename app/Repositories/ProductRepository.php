<?php 

namespace App\Repositories;

use App\Http\Helper;
use App\Interfaces\ProductInterface;
use App\Models\DirectDistributorUserData;

class ProductRepository implements ProductInterface
{
    public function getProduct($request)
    {
        try {
            $url = 'produto/cons_cad/prod/{2J3506}';
            $clientApiId = '6318';
            $clientApiKey = 'Global@#';
            $clientApiToken = 'MzExMjIwMjMuNjkxMzMzNTMwMDAxNjYuU0lTUkVWQVBJU2lzcmV2IEluZm9ybWF0aWNhIEx0ZGEu';

            $api = json_decode($this->ConnectApi($url, $clientApiKey, $clientApiId, $clientApiToken));

            $response = [];

            if ($api) {
                foreach ($api->rows as $row) {
                    if ($row->codfor == 6465 || $row->codfor == 6442) {
                        $response[] = [
                            "produto" => $row->produto,
                            "descricao" => $row->descricao,
                            "peso" => $row->peso,
                            "ncm" => $row->ncm,
                            "marca" => $row->marca,
                            "codfor" => $row->codfor,
                            "saldo" => $row->saldo,
                            "precovenda" => $row->precovenda,
                        ];
                    }
                }
            }

            return $response;
        // erro
        } catch (\Throwable $th) {
            return $th;
        }
    }

    private function ConnectApi($url, $clientApiKey, $clientApiId, $clientApiToken) {
        $ch = curl_init();

        // Defina a URL da API que você deseja chamar
        $url = 'http://172.16.10.27:8002/'.$url;

        // Configurar as opções do cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Configurar os cabeçalhos
        $headers = array(
            'Content-Type: application/json',
            'CLIENTEAPI_ID: '.$clientApiId,
            'CLIENTEAPI_KEY: '.$clientApiKey,
            'CLIENTEAPI_TOKEN: '.$clientApiToken,
        );

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Fazer a requisição GET
        $response = curl_exec($ch);

        // Verificar se houve algum erro
        if (curl_errno($ch)) {
            echo 'Erro na requisição: ' . curl_error($ch);
        }

        // Fechar a conexão cURL
        curl_close($ch);

        return $response;
    }
}