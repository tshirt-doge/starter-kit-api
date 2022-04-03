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

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;

class ApiErrorResponse
{
    public const VALIDATION_ERROR = 'VALIDATION_ERROR';
    public const RESOURCE_NOT_FOUND = 'RESOURCE_NOT_FOUND_ERROR';
    public const INVALID_CREDENTIALS = 'INVALID_CREDENTIALS_ERROR';
    public const SMTP_ERROR = 'SMTP_ERROR';
    public const UNAUTHORIZED_ERROR = 'UNAUTHORIZED_ERROR';
    public const FORBIDDEN_ERROR = 'FORBIDDEN_ERROR';
    public const UNKNOWN_ROUTE = 'UNKNOWN_ROUTE_ERROR';
    public const RATE_LIMIT = 'TOO_MANY_REQUESTS_ERROR';
    public const DEPENDENCY_ERROR = 'DEPENDENCY_ERROR';
    public const SERVER_ERROR = 'SERVER_ERROR';
    public const INCORRECT_OLD_PASSWORD = 'INCORRECT_OLD_PASSWORD_ERROR';

    /***
     * Creates and returns a custom API error message
     *
     * @param string $message
     * @param array|null $errors
     * @param int $statusCode
     * @param String $errorCode
     *
     * @return HttpResponseException
     */
    public static function createErrorResponse(string $message, int $statusCode, string $errorCode = ApiErrorResponse::SERVER_ERROR, array $errors = null): HttpResponseException
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
