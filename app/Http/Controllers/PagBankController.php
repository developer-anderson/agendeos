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
                            "name"=> $user->name,
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
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), "status" => 500, "dados" => $dados], 500);
        }
    }
    public function buscarAssinante($id)
    {
        $dadosPagBank = GatewayPagamento::query()->where("nome", "PagBank")->first();
        $url = $dadosPagBank->endpoint_producao.'customers/'.$id;
        $apiKey = $dadosPagBank->token_producao;

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
            return $decodedResponse['id'];
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function criarAssinatura(Request $request)
    {
        $user = User::query()->where('id',$request->user_id)->first();

        if(isset($user->gateway_assinante_id) and !empty($user->gateway_assinante_id)){
            $cliente_id = $this->buscarAssinante($user->gateway_assinante_id);
        }else{
            $cliente_id = $this->criarAssinante($request->all());
        }
        if(empty($request->cartaoHash) or !isset($request->cartaoHash)){
            return response()->json(["message" => "Informe o cartão de crédito", "error" => true], 401);
        }
        if(isset($cliente_id->original))
            return response()->json($cliente_id->original, 500);
        $dadosPagBank = GatewayPagamento::query()->where("nome", "PagBank")->first();
        $url = $dadosPagBank->endpoint_producao.'subscriptions';
        $apiKey = $dadosPagBank->token_producao;

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
                    "data_assinatura" =>date("Y-m-d"), "data_renovacao" => $dataFuturaFormatada  ]);
                return response()->json(['error' => false, 'response' => $decodedResponse], 200);

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
