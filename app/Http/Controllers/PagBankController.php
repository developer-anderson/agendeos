<?php

namespace App\Http\Controllers;
use App\Models\Empresas;
use App\Models\GatewayPagamento;
use App\Models\Planos;
use App\Models\User;
use App\Models\UsuarioAssinatura;
use Illuminate\Support\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagBankController extends Controller
{
    public function criarAssinante($data)
    {
        $dadosPagBank = GatewayPagamento::query()->where("nome", "PagBank")->first();
        $url = $dadosPagBank->endpoint_producao.'customers';
        $apiKey = $dadosPagBank->token_producao;
        $user = User::query()->where('id', $data['user_id'])->first();
        $empresaUser = Empresas::query()->where("id", $user->empresa_id)->first();
        $dados = [
            'address' => [
                'country' => 'BRA',
                'street' => $user->logradouro ?? "sem logradouro",
                'number' => $user->numero ?? "00",
                'complement' => $user->complemento ?? "sem logradouro",
                'locality' => $user->cidade ?? "sem logradouro",
                'city' => $user->cidade ?? "Salvador",
                'region_code' => $user->estado ?? "BA",
                'postal_code' => str_replace(array(".", "-"), "", $user->cep) ?? "40000000",
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
                    'type' => '',
                    'card' => [
                        'encrypted' => $data["cartaoHash"],
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
            $decodedResponse = json_decode($body, true);
            if($statusCode >= 200 and $statusCode <= 299){
                $user->update(["gateway_assinante_id" => $decodedResponse["id"] ]);

                return response()->json(['cliente_id' => $decodedResponse['id']], 200);

            }
            return response()->json(['error' => true], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function criarAssinatura(Request $request)
    {
        $cliente_id = $this->criarAssinante($request->all());
        $dadosPagBank = GatewayPagamento::query()->where("nome", "PagBank")->first();
        $url = $dadosPagBank->endpoint_producao.'subscriptions';
        $apiKey = $dadosPagBank->token_producao;
        $user = User::query()->where('id',$request->user_id)->first();
        $empresaUser = Empresas::query()->where("id", $user->empresa_id)->first();
        $planoAssinado = Planos::query()->where("id", $empresaUser->plano_id)->first();
        $assinatura = UsuarioAssinatura::query()->where("user_id", $user->id)
            ->where("plano_id", $planoAssinado->id)->where("ativo", 0)
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
                    'accept' => 'application/json',
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
                $assinatura->update(["referencia_id" => $decodedResponse["id"], "ativo"  => 1,
                    "data_assinatura" =>$dataAtualFormatada, "data_renovacao" => $dataFuturaFormatada  ]);

            }
            return response()->json(['error' => true, 'status' => $statusCode], 500);
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
