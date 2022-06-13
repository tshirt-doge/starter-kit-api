<?php

namespace App\Http\Controllers;

use App\Enums\ApiErrorCode;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    use ApiResponder;

    /**
     * Login a user
     */
    public function login(AuthRequest $request): JsonResponse
    {
        $user = User::whereEmail($request['email'])->first();

        if (!$user || !Hash::check($request['password'], $user->password)) {
            $this->throwError('Invalid credentials', Response::HTTP_UNAUTHORIZED, ApiErrorCode::INVALID_CREDENTIALS);
        }

        $token = $user->createToken('api_token')->plainTextToken;
        $type = 'Bearer';

        return $this->success(['user' => $user, 'access_token' => $token, 'token_type' => $type], Response::HTTP_OK);
    }

    /**
     * Logout a user
     */
    public function logout(AuthRequest $request): JsonResponse
    {
        $revokeAllTokens = $request->get('all');

        if ($revokeAllTokens) {
            Auth::user()->tokens()->delete();
        } else {
            Auth::user()->currentAccessToken()->delete();
        }

        return $this->success(['message' => $revokeAllTokens ? 'All devices have been logged out' : 'Logout success'], Response::HTTP_OK);
    }
}
