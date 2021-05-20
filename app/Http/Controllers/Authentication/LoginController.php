<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Requests\Authentication\RegisterRequest;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use ApiResponseTrait;
    public function login(LoginRequest $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $token = Auth::user()->createToken(env('NAME_TOKEN', 'course'));
            return $this->responseApi([
                'code' => $this->ok,
                'token' => $token->plainTextToken
            ]); 
        }else{
            return $this->responseApi([
                'message' => "Credenciales incorrectas",
                'code' => $this->wrong_credenciles,
            ]);
        }
    }


    
}
