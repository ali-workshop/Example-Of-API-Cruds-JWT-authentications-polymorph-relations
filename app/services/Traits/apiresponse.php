<?php

namespace App\services\Traits;

use Illuminate\Http\JsonResponse;

trait apiresponse{

    protected function successResponse($data, int $httpResponseCode = 200): JsonResponse
    {
        return response()->json([
            'success'    => true,
            'message'    => null,
            'data'       => $data,
            'errors'     => null,
        ], $httpResponseCode);
    }

    protected function errorResponse(string $message, ?array $errors = [], int $httpResponseCode = 400): JsonResponse {
        return response()->json([
            'success'    => false,
            'message'    => $message ?? null,
            'data'       => null,
            'errors'     => $errors ?? null,
        ], $httpResponseCode);
    }
}