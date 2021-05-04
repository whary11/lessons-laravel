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

/**
* @OA\Info(title="API Usuarios", version="1.0")
*
* @OA\Server(url="http://lessons-laravel.test/")
*/

class LoginController extends Controller
{
    use ApiResponseTrait;
    /**
    * @OA\Post(
    *     path="/api/authentication/login",
    *     summary="Iniciar sesión",
    *     @OA\Response(
    *         response=200,
    *         description="Retorna la infomacion del token para las proximas peticiones."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     )
    * )
    */
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
