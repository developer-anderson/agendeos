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
    public function criarAssinatura()
    {
        $dadosPagBank = GatewayPagamento::query()->where("nome", "PagBank")->first();
        $url = $dadosPagBank->endpoint_producao.'subscriptions';
        $apiKey = $dadosPagBank->token_producao;

        // Substitua isso pelo seu vetor de dados
        $dados = [
            'plan' => [
                'id' => '1'
            ],
            'customer' => [
                'phones' => [
                    'country' => '55',
                    'area' => '71',
                    'number' => '993550327'
                ],
                'address' => [
                    'country' => 'BRA',
                    'street' => 'Travessa da grama',
                    'number' => '959',
                    'complement' => 'atras do shopping busca vida',
                    'locality' => 'abrantes',
                    'city' => 'camaçari',
                    'region_code' => 'BA',
                    'postal_code' => '42826408'
                ],
                'billing_info' => [
                    [
                        'card' => [
                            'holder' => [
                                'phone' => [
                                    'country' => '55',
                                    'area' => '71',
                                    'number' => '993550327'
                                ],
                                'name' => 'dono do cartao',
                                'birth_date' => '1997-10-27',
                                'tax_id' => '85915781551'
                            ],
                            'number' => '4539620659922097',
                            'exp_year' => '2026',
                            'exp_month' => '12'
                        ],
                        'type' => 'CREDIT_CARD'
                    ]
                ],
                'reference_id' => '2',
                'name' => 'anderson nascimento',
                'email' => 'asassa@gmail.com',
                'tax_id' => '85915781551',
                'birth_date' => '1997-10-27'
            ],
            'amount' => [
                'currency' => 'BRL',
                'value' => 10000
            ],
            'best_invoice_date' => [
                'day' => '1'
            ],
            'reference_id' => '10',
            'payment_method' => [
                [
                    'type' => 'CREDIT_CARD',
                    'card' => [
                        'security_code' => 123
                    ]
                ]
            ],
            'pro_rata' => false
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
    public function criarPEdidoPagamentoComCartaoCredito($data)
    {
        $dadosPagBank = GatewayPagamento::query()->where("nome", "PagBank")->first();
        $url = $dadosPagBank->endpoint_producao.'subscriptions';
        $apiKey = $dadosPagBank->token_producao;

        // Substitua isso pelo seu vetor de dados

        $client = new Client();
        try {
            $response = $client->request('POST', $url, [
                'body' => json_encode($data),
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
