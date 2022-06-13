<?php

namespace App\Traits;

/*
|--------------------------------------------------------------------------
| Api Responder Trait
|--------------------------------------------------------------------------
|
| This trait will be used by controllers for any response sent to clients.
|
*/

use App\Enums\ApiErrorCode;
use App\Helpers\ApiErrorResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

trait ApiResponder
{
    /**
     * Return a success JSON response.
     *
     * @param $data
     * @param int $statusCode
     * @param array $headers
     *
     * @return JsonResponse
     */
    protected function success($data, int $statusCode, array $headers = []): JsonResponse
    {
        return response()->json($data, $statusCode, $headers);
    }

    /**
     * Throw a formatted error message (We'll let Laravel handle it)
     *
     * @param string $message
     * @param int $statusCode
     * @param ApiErrorCode|null $errorCode
     * @param array|null $errors
     *
     * @return void
     */
    protected function throwError(string $message, int $statusCode, ApiErrorCode $errorCode = null, array $errors = null): void
    {
        throw ApiErrorResponse::createErrorResponse($message, $statusCode, $errorCode, $errors);
    }
}
