<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Responses\AccessTokenResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/login",
     *      tags={"Authentication"},
     *      summary="Log in",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Data for creating a new participant",
     *          @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Token details",
     *          @OA\JsonContent(ref="#/components/schemas/AccessTokenResponse")
     *      ),
     *      @OA\Response(
     *          response="401", 
     *          description="Invalid credentials",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="message", type="string", example="Credenciais inválidas.")
     *      )
     *  )
     * )
     */
    public function login(LoginRequest $request) {
        $credentials = [
            'email' => $request->email, // Campo personalizado para o login
            'password' => $request->password, // Campo padrão para a senha
        ];
    
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(["message" => "Credenciais inválidas."], 401);
        }
    
        return $this->respondWithToken($token);
    }
    
    /**
     * @OA\Get(
     *     path="/api/me",
     *     tags={"Authentication"},
     *     summary="Logged in user data",
     *     @OA\Response(
     *          response="401", 
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     ),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function me() {
        return response()->json(auth()->user());
    }
    
    /**
     * @OA\Post(
     *     path="/api/logout",
     *     tags={"Authentication"},
     *     summary="Logout",
     *     @OA\Response(
     *          response="200", 
     *          description="Logout",
     *          @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="integer", example="Logout efetuado com sucesso.")
     *         )
     *     ),
     *     @OA\Response(
     *          response="401", 
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     ),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function logout() {
        auth()->logout();
    
        return response()->json(['message' => 'Logout efetuado com sucesso!']);
    }
    
    /**
     * @OA\Post(
     *     path="/api/refresh-token",
     *     tags={"Authentication"},
     *     summary="Refresh the access token",
     *     @OA\Response(
     *          response="200", 
     *          description="Token details",
     *          @OA\JsonContent(ref="#/components/schemas/AccessTokenResponse")
     *     ),
     *     @OA\Response(
     *          response="401", 
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     ),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function refresh() {
        return $this->respondWithToken(auth()->refresh());
    }
    
    protected function respondWithToken($token) {
        $tokenData = new AccessTokenResponse($token);

        return $tokenData->toResponse();
    }
}
