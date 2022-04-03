<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * We'll change the rules based on the route
     */
    public function rules(): array
    {
        $routeName = $this->route()->getName();

        return match ($routeName) {
            'auth.login' => $this->getLoginRules(),
            'auth.logout' => $this->getLogoutRules(),
            default => [],
        };
    }

    /**
     * Login rules
     */
    private function getLoginRules(): array
    {
        return [
            'email' => ['string', 'required'],
            'password' => ['string', 'required']
        ];
    }

    /**
     * Logout rules
     */
    private function getLogoutRules(): array
    {
        return [
            'all' => ['nullable', 'boolean']
        ];
    }
}
