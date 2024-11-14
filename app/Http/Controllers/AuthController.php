<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request) {
        $credentials = [
            'email' => $request->email, // Campo personalizado para o login
            'password' => $request->password, // Campo padrão para a senha
        ];
    
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(["message" => "Credenciais inválidas."], 401);
        }
    
        return $this->respondWithToken($token);
    }
    
    public function me() {
        return response()->json(auth()->user());
    }
    
    public function logout() {
        auth()->logout();
    
        return response()->json(['message' => 'Logout efetuado com sucesso!']);
    }
    
    public function refresh() {
        return $this->respondWithToken(auth()->refresh());
    }
    
    protected function respondWithToken($token) {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
