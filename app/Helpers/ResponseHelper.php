<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ResponseHelper
{


    public static function makeSuccessResponse(string $message, mixed $data = null): JsonResponse
    {
        return  new JsonResponse([
            'message' => $message,
            'data' => $data
        ], Response::HTTP_OK);
    }

    public static function makeExceptionResponse(
        string $message,
        \Exception $exception,
        int $status = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        $result = [
            'message' => $message,
        ];

        if (config('app.debug', false)) {
            $result['e'] = $exception->getMessage();
            $result['t'] = $exception->getTrace();
        }

        return new JsonResponse($result, $status);
    }
}
