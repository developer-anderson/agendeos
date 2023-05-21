<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Events\PasswordReset;
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
        return response()->json(["error" => "false", 'token_acesso' => $token ,"msg" => "Informe o token para atualizar a senha"],200);
        //Mail::to($user->email)->send(new PasswordResetMail($token));

        //return back()->with(['status' => 'We have emailed your password reset link!']);
    }
    public function showResetPasswordForm(Request $request)
    {
        return view('auth.passwords.reset', ['token' => $request->route('token')]);
    }

    public function resetPassword(Request $request)
    {
        $user = User::where('email', $request->email, 'token', $request->token)->first();
        if (!$user) {

            return response()->json(["error" => "true", "msg" => "Token inválido"],200);
        }
        else{
             Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => bcrypt($password),
                    ])->setRememberToken(Str::random(60));

                    $user->save();


                }
            );
            return response()->json(["error" => "false","msg" => "Senha alterada com sucesso"],200);
        }



    }
}
