<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class CustomEnsureFrontendRequestsAreStateful
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $allowedRoutesWithoutToken = ['login', 'retornoPagamento', 'planosGetAll', 'agendamentosGetAll', 'planosShow', 'agendamentoShow',
            'empresacriar', 'empresaatualizar', 'cadastrar', 'token_recuperar_Senha', 'password.reset.resetPassword', 'segmentoAll', 'segmentoShow', 'trocar_senha', 'criarAssinatura'];
        if (!in_array($request->route()->getName(), $allowedRoutesWithoutToken) && !$request->bearerToken()) {
            return response()->json(['error' => true, 'message' => 'Token de autenticação ausente ou inválido.'], 401);
        }

        if ($request->bearerToken()) {
            $tokenExpiration = Auth::guard('web')->user()->token->expires_at ?? null;
            if ($tokenExpiration && now()->gt($tokenExpiration)) {
                return response()->json(['error' => true, 'message' => 'Token expirado.'], 401);
            }
        }

        return $next($request);
    }
}
