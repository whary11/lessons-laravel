<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginRequest;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use ResponseTrait;
    public function login(LoginRequest $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $token = Auth::user()->createToken("curse");
            return $this->responseTrait([
                'code' => $this->ok,
                'token' => $token->plainTextToken
            ]); 
        }else{
            return $this->responseTrait([
                'message' => "Credenciales incorrectas",
                'code' => $this->wrong_credenciles,
            ]);
        }
    }
}
