<?php

namespace App\Http\Controllers;
use App\Models\UsuarioAssinatura;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
// use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\fluxo_caixa;
class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        if (User::where('email', $data['email'])->count())
        {
            return response()->json(["error" => "true", "msg" => "O e-mail informado está associado a outra conta"],500);
        }
        else
        {
            $data['password'] = bcrypt( $data['password']);
            $dataAtual = Carbon::now();
            $dataFutura = $dataAtual->addDays(30);
            $dataFuturaFormatada = $dataFutura->format('Y-m-d');
            $user = User::create($data);
            $data = [];
            UsuarioAssinatura::create(["plano_id" => 1, "user_id" => $user->id, "ativo" => 1, "data_assinatura" => date("Y-m-d"), "data_renovacao" => $dataFuturaFormatada]);

            $data['token'] = $user->createToken('api-token')->plainTextToken;
            $vetor  = User::leftJoin('empresas', 'empresas.id', '=', 'users.empresa_id')->leftJoin('planos', 'planos.id', '=', 'empresas.plano_id')
                ->where('users.id',Auth::id())->select(['users.*', 'empresas.razao_social', 'empresas.plano_id', 'empresas.segmento_id', 'empresas.situacao', 'planos.recursos'])->first();
            $data = $vetor;
            $data['recursos'] = json_decode( $data['recursos'] , true);
            $data['receita'] = fluxo_caixa::getAllMoney();
            $data['token_expiracao'] = now()->addMinutes(config('sanctum.expiration'));
            $data["assinatura"] = UsuarioAssinatura::query()->where("user_id", $user->id)->where("ativo", 1)->first();
            return response()->json($vetor, 200);

        }

    }
}
