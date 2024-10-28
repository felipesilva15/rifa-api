<?php

namespace App\Exceptions;

use App\Http\Responses\ErrorResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class NotFoundHttpException extends HttpException
{
    public function __construct(string $message = 'Registro não encontrado.', \Throwable $previous = null, int $code = 0, array $headers = []) {
        parent::__construct(404, $message, $previous, $headers, $code);
    }

    public function render(Request $request) {
        $error = new ErrorResponse($this->message, $request->path(), $this->code);

        return $error->toResponse();
    }
}