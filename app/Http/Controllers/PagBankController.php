<?php

namespace App\Http\Controllers;
use App\Models\Agendamento;
use App\Models\AgendamentoItem;
use App\Models\Empresas;
use App\Models\fluxo_caixa;
use App\Models\GatewayPagamento;
use App\Models\ordem_servico_servico;
use App\Models\OrdemServicos;
use App\Models\Planos;
use App\Models\User;
use App\Models\UsuarioAssinatura;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagBankController extends Controller
{
    public function criarAssinante($data)
    {
        $dadosPagBank = GatewayPagamento::query()->where("nome", "PagBank")->first();
        if($dadosPagBank->producao){
            $apiKey = $dadosPagBank->token_producao;
            $url = $dadosPagBank->endpoint_producao.'customers';
        }
        else{
            $url = $dadosPagBank->endpoint_homologacao.'customers';
            $apiKey = $dadosPagBank->token_homologacao;
        }
        $user = User::query()->where('id', $data['user_id'])->first();
        $empresaUser = Empresas::query()->where("id", $user->empresa_id)->first();

        if(empty($data["cartaoHash"]) or !isset($data["cartaoHash"])){
            return response()->json(["message" => "Informe o cartão de crédito", error => true], 401);
        }
        $dados = [
            'address' => [
                'country' => 'BRA',
                'street' => $data["logradouro"] ?? $user->logradouro,
                'number' => $data["numero"] ?? $user->numero,
                'complement' => $data["complemento"] ?? $user->complemento,
                'locality' => $data["cidade"] ?? $user->cidade ,
                'city' => $data["cidade"] ?? $user->cidade,
                'region_code' => $data["estado"] ?? $user->estado,
                'postal_code' => str_replace(array(".", "-"), "", $data["cep"] ?? $user->cep),
            ],
            'reference_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'tax_id' => str_replace(array(".", "-"), "", $data["cpf"]),
            'phones' => [
                [
                    'country' => '55',
                    'area' => $data["ddd"],
                    'number' => $data["telefone"],
                ],
            ],
            'birth_date' => $data["aniversario"],
            'billing_info' => [
                [
                    'card' => [
                        'encrypted' => $data["cartaoHash"],
                        "holder"=> [
                            "name"=> $data["nome_titular"] ?? $user->name,
                              "birth_date"=> $data["aniversario"],
                              "tax_id"=> str_replace(array(".", "-"), "", $data["cpf"])
                        ],
                    ],
                    "type"=> "CREDIT_CARD"
                ],
            ],
        ];
        $client = new Client();
        try {
            $response = $client->request('POST', $url, [
                'body' => json_encode($dados),
                'headers' => [
                    'content-type' => 'application/json',
                    'Authorization' => 'Bearer ' . $apiKey,
                ],
            ]);
            $body = $response->getBody()->getContents();
            $decodedResponse = json_decode($body, true);
            $user->gateway_assinante_id = $decodedResponse['id'];
            $user->save();

            return $decodedResponse['id'];
        } catch (RequestException $e) {
            // Verifica se a exceção tem uma resposta HTTP associada
            if ($e->hasResponse()) {
                $responseBody = $e->getResponse()->getBody()->getContents();
                $responseData = json_decode($responseBody, true);
                $errorMessage = $responseData['error_messages'][0]['description'];
                return response()->json(['error' => $errorMessage, "status" => 500, "dados" => $dados, "url" => $url, "response_pagbank" => $responseData], 500);
            } else {
                return response()->json(['error' => $e->getMessage(), "status" => 500, "dados" => $dados], 500);
            }
        }
    }
    public function buscarAssinante($id)
    {
        $dadosPagBank = GatewayPagamento::query()->where("nome", "PagBank")->first();
        if($dadosPagBank->producao){
            $url = $dadosPagBank->endpoint_producao.'customers/'.$id;
            $apiKey = $dadosPagBank->token_producao;
        }
        else{
            $url = $dadosPagBank->endpoint_homologacao.'customers';
            $apiKey = $dadosPagBank->token_homologacao;
        }
        $client = new Client();
        try {
            $response = $client->request('GET', $url, [
                'headers' => [
                    'content-type' => 'application/json',
                    'Authorization' => 'Bearer ' . $apiKey,
                ],
            ]);
            $body = $response->getBody()->getContents();
            $decodedResponse = json_decode($body, true);
            logger($url);
            logger('GET');
            logger($body);
            logger("__");
            logger($decodedResponse["customers"]);
            return $decodedResponse["customers"]['id'];
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function criarAssinatura(Request $request)
    {
        $user = User::query()->where('id',$request->user_id)->first();

        $cliente_id = $user->gateway_assinante_id ? $user->gateway_assinante_id : $this->criarAssinante($request->all());
        if(empty($request->cartaoHash) or !isset($request->cartaoHash)){
            return response()->json(["message" => "Informe o cartão de crédito", "error" => true], 401);
        }
        if(isset($cliente_id->original))
            return response()->json($cliente_id->original, 500);
        $dadosPagBank = GatewayPagamento::query()->where("nome", "PagBank")->first();
        if($dadosPagBank->producao){
            $url = $dadosPagBank->endpoint_producao.'subscriptions';
            $apiKey = $dadosPagBank->token_producao;
        }
        else{
            $url = $dadosPagBank->endpoint_homologacao.'subscriptions';
            $apiKey = $dadosPagBank->token_homologacao;
        }
        $empresaUser = Empresas::query()->where("id", $user->empresa_id)->first();
        $planoAssinado = Planos::query()->where("id", $empresaUser->plano_id)->first();
        $assinatura = UsuarioAssinatura::query()->where("user_id", $user->id)
            ->where("plano_id", $planoAssinado->id)
            ->whereNull("referencia_id")
            ->first();
        if(!$assinatura){
            $assinatura = UsuarioAssinatura::create(["plano_id" => $planoAssinado->id, "user_id" => $user->id, "ativo" => 0, "data_assinatura" => date("Y-m-d")]);
        }
        $data = array(
            "plan" => array(
                "id" => $planoAssinado->gateway_plano_id
            ),
            "customer" => array(
                "id" => $cliente_id,
                "billing_info" => array(
                    array(
                        "card" => array(
                            "holder" => array(
                                "phone" => array(
                                    'country' => "55",
                                    'area' => $request->ddd,
                                    'number' => $request->telefone
                                ),
                                'name' => $request->nome_titular,
                                'birth_date' => $request->aniversario,
                                'tax_id' => str_replace(array(".", "-"), "", $request->cpf)
                            ),
                            "encrypted" => $request->cartaoHash
                        ),
                        "type" => "CREDIT_CARD"
                    )
                )
            ),
            "amount" => array(
                "currency" => "BRL",
                "value" => $planoAssinado->valor
            ),
            "reference_id" => $assinatura->id,
            "payment_method" => array(
                array(
                    "type" => "CREDIT_CARD",
                    "card" => array(
                        "security_code" => $request->cvv
                    )
                )
            ),
            "pro_rata" => false
        );

        $client = new Client();
        try {
            $response = $client->request('POST', $url, [
                'body' => json_encode($data),
                'headers' => [
                    'content-type' => 'application/json',
                    'Authorization' => 'Bearer ' . $apiKey,
                ],
            ]);

            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();
            $decodedResponse = json_decode($body, true);

            if($statusCode >= 200 and $statusCode <= 299){
                $dataAtual = Carbon::now();
                $dataFutura = $dataAtual->addDays(30);
                $dataAtualFormatada = $dataAtual->format('Y-m-d');
                $dataFuturaFormatada = $dataFutura->format('Y-m-d');
                $assinatura->update(["referencia_id" => $decodedResponse["id"], "ativo"  => 1,"teste"  => 0, "data_pagamento" => date("Y-m-d"),
                    "data_assinatura" =>date("Y-m-d"), "data_renovacao" => $dataFuturaFormatada  ]);
                return response()->json(['error' => false, 'response' => $decodedResponse], 200);

            }
            return response()->json(['error' => true, 'status' => $statusCode], 500);
        } catch (RequestException $e) {
            $responseBody = $e->getResponse()->getBody()->getContents();
            $responseData = json_decode($responseBody, true);
            $errorMessage = $responseData['error_messages'][0]['description'];
            return response()->json(['error' => $errorMessage], 500);
        }
    }
    public function criarPagarPedidoPagamento(Request $request)
    {
        $dadosPagBank = GatewayPagamento::query()->where("nome", "PagBank")->first();
        $agendamento = Agendamento::query()->where("id", $request->agendamento_id)->first();

        if($dadosPagBank->producao){
            $url = $dadosPagBank->endpoint_producao."orders";
            $apiKey = $dadosPagBank->token_producao;
        }
        else{
            $url = $dadosPagBank->endpoint_homologacao."orders";
            $apiKey = $dadosPagBank->token_homologacao;
        }
        $totalITens = $this->itensAgendamentoValorTotal($agendamento);
        $taxa = 100;
        $total = $totalITens + $taxa;
        $itens = [];
        foreach ($this->itensAgendamento($agendamento) as $item) {
            $itens[] =  [
                "reference_id" => " ",
                "name" => "nome do item",
                "quantity" => 1,
                "unit_amount" => $item["valor"]
            ];
        }
        $client = new Client();
        $data = [
            "reference_id" => "agendamento",
            "customer" => [
                "name" => $request->nome,
                "email" => $request->email,
                "tax_id" => $request->cpf,
                "phones" => [
                    [
                        "country" => "55",
                        "area" => "11",
                        "number" => "999999999",
                        "type" => "MOBILE"
                    ]
                ]
            ],
            "items" => $itens,
            "shipping" => [
                "address" => [
                    "street" => "Avenida Brigadeiro Faria Lima",
                    "number" => "1384",
                    "complement" => "apto 12",
                    "locality" => "Pinheiros",
                    "city" => "São Paulo",
                    "region_code" => "SP",
                    "country" => "BRA",
                    "postal_code" => "01452002"
                ]
            ],
            "notification_urls" => [
                "https://agendos.com.br/retorno_pagamento"
            ],
            "charges" => [
                [
                    "reference_id" => $request->agendamento_id,
                    "description" => "Pagamento dos serviçoes referentes ao agendamento",
                    "amount" => [
                        "value" => $total,
                        "currency" => "BRL"
                    ],
                    "payment_method" => [
                        "type" => "CREDIT_CARD",
                        "installments" => 1,
                        "capture" => true,
                        "card" => [
                            "number" => "4111111111111111",
                            "exp_month" => "12",
                            "exp_year" => "2026",
                            "security_code" => "123",
                            "holder" => [
                                "name" => $request->nome,
                                "tax_id" => $request->cpf
                            ],
                            "store" => false
                        ]
                    ],
                    "splits" => [
                        "method" => "FIXED",
                        "receivers" => [
                            [
                                "account" => [
                                    "id" => "ACCO_12345"
                                ],
                                "amount" => [
                                    "value" => "6000"
                                ]
                            ],
                            [
                                "account" => [
                                    "id" => "ACCO_67890"
                                ],
                                "amount" => [
                                    "value" => "4000"
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
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
            if($statusCode >= 200 and $statusCode <= 299){
                $agendamento->situacao_id = 2;
                $agendamento->forma_pagamento_id = 3;
                $agendamento->save();
            }
            return $body;
        } catch (\Exception $e) {
            // Tratar erros, se necessário
            return null;
        }
    }

    public function gerarComanda($agendamento)
    {
        $comanda = OrdemServicos::create(
            [
                "id_cliente" => $agendamento->clientes_id,
                "id_funcionario" => $agendamento->funcionario_id,
                "id_servico" => 0,
                "situacao" => $agendamento->situacao_id,
                "id_forma_pagamento" => $agendamento->forma_pagamento_id,
                "inicio_os" => $agendamento->data_agendamento." ".$agendamento->hora_agendamento,
                "previsao_os" => $agendamento->data_agendamento." ".$agendamento->hora_agendamento,
                "user_id" => $agendamento->user_id,
            ]
        );
        $comanda->valor = 0;
        foreach ($this->itensAgendamento($agendamento->id) as $item) {
            $valor_temp = $item['valor'];
            $comanda->valor += $valor_temp;
            $data = array(
                "os_id"      => $comanda->id,
                "id_servico" => $item['servicos_id'],
                "quantidade" => $item['quantidade'] ?? 1,
                "valor" => $valor_temp
            );
            ordem_servico_servico::create($data);
        }
        $this->gerarFluxoCaixa($comanda);
    }
    public function gerarFluxoCaixa($data)
    {
        $data['cliente_id'] = $data['id_cliente'];
        $data['os_id'] = $data['id'];

        $data['nome'] = "Ordem de Serviço #" . $data['os_id'];
        $data['produto_id'] = null;
        $data['pagamento_id'] = 3;
        $data['data'] = date("Y-m-d");
        $data['tipo_id'] = 1;
        fluxo_caixa::create($data);
        return true;
    }
    public function itensAgendamento($agendamento)
    {
        return AgendamentoItem::query()->where("agendamento_id", $agendamento->id)->get();
    }
    public function itensAgendamentoValorTotal($agendamento)
    {
        return AgendamentoItem::query()->where("agendamento_id", $agendamento->id)->sum('valor');
    }

}
