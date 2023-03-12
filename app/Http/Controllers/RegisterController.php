<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
// use App\Http\Requests\RegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
  
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) 
        {
            return response()->json(["error" => "true", "msg" => "O e-mail informado está associado a outra conta"],500);
        }
        else
        {
            $attributes = request()->validate([
                'username' => 'required|max:255|min:2',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|min:5|max:255'
            ]);
            
            $user = User::create($attributes);
            auth()->login($user);
            return response()->json(Auth::id(), 200);
        }
        return redirect('/dashboard');
    }
}
