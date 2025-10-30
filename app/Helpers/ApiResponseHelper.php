<?php

namespace App\Helpers;

use Throwable;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ApiResponseHelper
{
    public static function errorResponse(Throwable $e, bool $debug = false): JsonResponse
    {
        $statusCode = 500;
        $errors = [];
        $message = '';

        if ($e instanceof ValidationException) {
            $statusCode = 422;
            $errors = $e->errors();
            $message = $e->getMessage();
        } elseif ($e instanceof HttpExceptionInterface) {
            $statusCode = $e->getStatusCode();
            $message = self::defaultMessage($statusCode);
        } else {
            $message = self::defaultMessage($statusCode);
        }

        $response = [
            'status'  => 'error',
            'message' => $message,
        ];

        if (!empty($errors)) {
            $response['errors'] = $errors;
        }

        // if ($debug) {
        //     $response['exception'] = [
        //         'class'   => get_class($e),
        //         'message' => $e->getMessage(),
        //         'trace'   => $e->getTrace(),
        //     ];
        // }

        return response()->json($response, $statusCode);
    }

    private static function defaultMessage(int $statusCode): string
    {
        return match ($statusCode) {
            400 => 'Bad Request',
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            422 => 'Unprocessable Entity',
            500 => 'Internal Server Error',
            default => 'Unexpected Error',
        };
    }
}
