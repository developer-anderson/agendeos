<?php

namespace App\Http\Controllers;

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
            //$token = $user->createToken('API Token')->accessToken;
            //$request->session()->regenerate();
            $data = [];
            $vetor  = User::leftJoin('empresas', 'empresas.id', '=', 'users.empresa_id')->leftJoin('planos', 'planos.id', '=', 'empresas.plano_id')
            ->where('users.id',Auth::id())->select(['users.*', 'empresas.razao_social', 'empresas.plano_id', 'empresas.segmento_id', 'empresas.situacao', 'planos.recursos'])->first();
            $data = $vetor;
            $data['recursos'] = json_decode( $data['recursos'] , true);
            $data['receita'] = fluxo_caixa::getAllMoney(Auth::id());
            $data['token'] =   csrf_token();

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
