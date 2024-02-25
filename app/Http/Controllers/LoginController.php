<?php

namespace App\Http\Controllers;

use App\Models\Empresas;
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
                    'planos.recursos', 'empresas.slug'])->first();
            $empresa = Empresas::query()->where("id", $vetor->empresa_id)->first();
            $data = $vetor;
            $data["link_agendamento"] = "https://agendos.com.br/agendamento/".$vetor->slug;
            $data['recursos'] = json_decode( $data['recursos'] , true);
            $data["horarios_funcionamento"] = $this->formatarHorariosFuncionamento($empresa);
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
    public function formatarHorariosFuncionamento($empresas){
        $data = [
            "domingo" => [
                "disponivel" => $empresas->domingo,
                "horario_fim" => $empresas->domingo_horario_fim,
                "horario_inicio" => $empresas->domingo_horario_inicio
            ],
            "segunda" => [
                "disponivel" => $empresas->segunda,
                "horario_fim" => $empresas->segunda_horario_fim,
                "horario_inicio" => $empresas->segunda_horario_inicio
            ],
            "terca" => [
                "disponivel" => $empresas->terca,
                "horario_fim" => $empresas->terca_horario_fim,
                "horario_inicio" => $empresas->terca_horario_inicio
            ],
            "quarta" => [
                "disponivel" => $empresas->quarta,
                "horario_fim" => $empresas->quarta_horario_fim,
                "horario_inicio" => $empresas->quarta_horario_inicio
            ],
            "quinta" => [
                "disponivel" => $empresas->quinta,
                "horario_fim" => $empresas->quinta_horario_fim,
                "horario_inicio" => $empresas->quinta_horario_inicio
            ],
            "sexta" => [
                "disponivel" => $empresas->sexta,
                "horario_fim" => $empresas->sexta_horario_fim,
                "horario_inicio" => $empresas->sexta_horario_inicio
            ],
            "sabado" => [
                "disponivel" => $empresas->sabado,
                "horario_fim" => $empresas->sabado_horario_fim,
                "horario_inicio" => $empresas->sabado_horario_inicio
            ],
        ];
        return $data;
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
