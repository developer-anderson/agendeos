<?php

namespace App\Http\Controllers;
use App\Models\Empresas;
use App\Models\UsuarioAssinatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
// use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\fluxo_caixa;
class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

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
            $user = User::create($data);
            $Empresas = Empresas::create(["razao_social" => $data["name"]]);
            $user->empresa_id = $Empresas->id;
            Auth::attempt(['email' => $request->email, 'password' => $request->password]);
            $data = [];
            $vetor  = User::leftJoin('empresas', 'empresas.id', '=', 'users.empresa_id')->leftJoin('planos', 'planos.id', '=', 'empresas.plano_id')
                ->where('users.id',Auth::id())
                ->select(['users.*', 'empresas.razao_social', 'empresas.plano_id', 'empresas.segmento_id', 'empresas.situacao', 'planos.recursos'])
                ->first();
            $data = $vetor;
            $data['recursos'] = json_decode( $data['recursos'] , true);
            $data['receita'] = fluxo_caixa::getAllMoney(Auth::id());
            $data['token_expiracao'] = now()->addMinutes(config('sanctum.expiration'));
            $data['token'] = $user->createToken('api-token')->plainTextToken;
            $data["assinatura"] = UsuarioAssinatura::query()->where("user_id", $user->id)->where("ativo", 1)->first();


            return response()->json($vetor, 200);

        }

    }
}
