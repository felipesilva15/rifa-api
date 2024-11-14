<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

/**
 * @OA\Schema(
 *      schema="AccessTokenResponse",
 *      @OA\Property(property="access_token", type="string", example="token123"),
 *      @OA\Property(property="token_type", type="string", example="bearer"),
 *      @OA\Property(property="expires_in", type="number", example=3600)
 * )
 */
class AccessTokenResponse
{
    protected string $access_token;
    protected string $token_type;
    protected int $expires_in;

    public function __construct(string $token) {
        $this->access_token = $token;
        $this->token_type = 'bearer';
        $this->expires_in = auth('api')->factory()->getTTL() * 60;
    }

    public function toResponse(): JsonResponse
    {
        return response()->json([
            'access_token' => $this->access_token,
            'token_type' => $this->token_type,
            'expires_in' => $this->expires_in
        ], 200);
    }
}