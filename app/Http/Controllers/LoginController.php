<?php

namespace App\Http\Controllers;

use App\Models\UsuarioAssinatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;
use App\Models\fluxo_caixa;
use App\Models\User;
class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('api-token')->plainTextToken;
            $data = [];
            $vetor  = User::leftJoin('empresas', 'empresas.id', '=', 'users.empresa_id')->leftJoin('planos', 'planos.id', '=', 'empresas.plano_id')
            ->where('users.id',Auth::id())->select(['users.*', 'empresas.razao_social', 'empresas.plano_id', 'empresas.segmento_id', 'empresas.situacao',
                    'segunda_horario_inicio', 'segunda_horario_fim', 'terca_horario_inicio', 'terca_horario_fim',
                    'quarta_horario_inicio', 'quarta_horario_fim','quinta_horario_inicio', 'quinta_horario_fim',
                    'sexta_horario_inicio', 'sexta_horario_fim', 'sabado_horario_inicio', 'sabado_horario_fim',
                    'domingo_horario_inicio', 'domingo_horario_fim', "segunda", "terca", "quarta", "quinta","sexta","sabado", "domingo",
                    'planos.recursos'])->first();
            $data = $vetor;
            $data['recursos'] = json_decode( $data['recursos'] , true);
            $data['receita'] = fluxo_caixa::getAllMoney();
            $data['token_expiracao'] = now()->addMinutes(config('sanctum.expiration'));
            $data["assinatura"] = UsuarioAssinatura::query()->where("user_id", $user->id)->where("ativo", 1)->first();
            $data['token'] =  $token ;

            return response()->json($data, 200);
        } else {
            return response()->json(["error" => "true", "msg" => "Dados inválidos"],401);
        }



        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
