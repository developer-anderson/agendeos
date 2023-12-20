<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\PasswordResetMail;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class PasswordResetController extends Controller
{
    public function showResetForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {

            return response()->json(["error" => "true", "msg" => "O e-mail informado não encontra-se em nossa base de dados"],200);
        }

        $token = Str::random(60);

        DB::table('password_resets')->insert([
            'email' => $user->email,
            'token' => $token,
            'created_at' => now()
        ]);
        //return response()->json(["error" => "false", 'token_acesso' => $token ,"msg" => "Informe o token para atualizar a senha"],200);
        Mail::to($user->email)->send(new PasswordResetMail($token));

        return response()->json(["error" => "false","msg" => "Informe o token enviado por e-mail"],200);
    }
    public function showResetPasswordForm(Request $request)
    {
        return view('auth.passwords.reset', ['token' => $request->route('token')]);
    }

    public function resetPassword(Request $request)
    {
        if(empty($request->password) or empty($request->password_confirmation) or empty($request->token) or empty($request->email))
        {
            return response()->json(["error" => "true","msg" => "Todos os dados precisam ser preenchidos"],200);
        }
        $token = PasswordReset::where('email', $request->email)->where('token', $request->token)->first();
        if (!$token) {

            return response()->json(["error" => "true", "msg" => "Token inválido"],401);
        }
        else{
            if($request->password <> $request->password_confirmation)
            {
                return response()->json(["error" => "true","msg" => "As senhas precisams er iguais"],200);
            }
            $user = User::where('email', $request->email)->first();
            $user->password = bcrypt($request->password);
            $user->remember_token = Str::random(60);
            $user->save();
            return response()->json(["error" => "false","msg" => "Senha alterada com sucesso"],200);
        }



    }
}
