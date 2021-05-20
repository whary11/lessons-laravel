<?php

namespace App\Http\Controllers;

use App\Http\Requests\Authentication\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken(env('NAME_TOKEN', 'course'))->plainTextToken;
        return $this->responseApi([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ],'success','Usuario registrado, disffruta la plataforma.');
    }
}
