<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

/**
 * @OA\Schema(
 *      schema="ErrorResponse",
 *      @OA\Property(property="message", type="string", example="Error ocorried."),
 *      @OA\Property(property="route", type="string", example="api/error")
 * )
 */
class ErrorResponse
{
    protected string $message;
    protected string $route;
    protected int $code;

    public function __construct(string $message, string $route, int $code = 400) {
        $this->message = $message;
        $this->route = $route;
        $this->code = $code;
    }

    public function toResponse(): JsonResponse
    {
        return response()->json([
            'message' => $this->message,
            'route' => $this->route,
        ], $this->code);
    }
}