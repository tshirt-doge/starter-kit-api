<?php

namespace App\Helpers;

/*
|--------------------------------------------------------------------------
| ApiErrorResponse
|--------------------------------------------------------------------------
|
| Used for creating uniform error responses back to the client
|
*/

use App\Enums\ApiErrorCode;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;

class ApiErrorResponse
{
    /***
     * Creates and returns a custom API error message
     *
     * @param string $message
     * @param int $statusCode
     * @param ApiErrorCode $errorCode
     * @param array|null $errors
     *
     * @return HttpResponseException
     */
    public static function createErrorResponse(string $message, int $statusCode, ApiErrorCode $errorCode = ApiErrorCode::SERVER_ERROR, array $errors = null): HttpResponseException
    {
        $response = [
            'error_code' => $errorCode,
            'message' => $message,
            'errors' => $errors
        ];

        $logErrorMsg = $errors ? $message . ' - ' . implode('|', $errors) : $message;

        if ($statusCode >= 500) {
            Log::error($logErrorMsg);

            // Hide the actual error from the client
            $response['errors'] = null;
        }

        return new HttpResponseException(response($response, $statusCode));
    }
}
