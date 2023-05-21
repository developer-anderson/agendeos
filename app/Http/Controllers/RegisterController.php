<?php

namespace App\Http\Controllers;
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
            Auth::attempt(['email' => $request->email, 'password' => $request->password]);
            $request->session()->regenerate();
            $vetor  = User::find(Auth::id());

            $vetor['receita'] = fluxo_caixa::getAllMoney(Auth::id());
            return response()->json($vetor, 200);

        }

    }
}
