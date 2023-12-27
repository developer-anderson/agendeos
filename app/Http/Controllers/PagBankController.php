<?php

namespace App\Http\Controllers;
use App\Models\GatewayPagamento;
use GuzzleHttp\Client;
class PagBankController extends Controller
{
    public function criarAssinante()
    {
        $dadosPagBank = GatewayPagamento::query()->where("nome", "PagBank")->first();
        $url = $dadosPagBank->endpoint_producao.'customers';
        $apiKey = $dadosPagBank->token_producao;

        // Substitua isso pelo seu vetor de dados
        $dados = [
            'address' => [
                'country' => 'BRA',
                'street' => 'string',
                'number' => 'string',
                'complement' => 'string',
                'locality' => 'string',
                'city' => 'string',
                'region_code' => 'string',
                'postal_code' => 'string',
            ],
            'reference_id' => '14',
            'name' => 'string',
            'email' => 'string',
            'tax_id' => 'string',
            'phones' => [
                [
                    'country' => 'string',
                    'area' => 'string',
                    'number' => 'string',
                ],
            ],
            'birth_date' => '2023-12-27',
            'billing_info' => [
                [
                    'type' => '',
                    'card' => [
                        'encrypted' => 'string',
                        'number' => 'string',
                        'exp_year' => 'string',
                        'exp_month' => 'string',
                        'holder' => [
                            'name' => 'string',
                            'birth_date' => 'string',
                            'tax_id' => 'string',
                            'phone' => [
                                'country' => 'string',
                                'area' => 'string',
                                'number' => 'string',
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $client = new Client();
        try {
            $response = $client->request('POST', $url, [
                'body' => json_encode($dados),
                'headers' => [
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                    'Authorization' => 'Bearer ' . $apiKey,
                ],
            ]);

            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();

            return response()->json(['statusCode' => $statusCode, 'response' => $body]);
        } catch (\Exception $e) {
            // Tratar erros, se necessário
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
