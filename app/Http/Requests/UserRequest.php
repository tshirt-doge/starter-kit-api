<?php

namespace App\Http\Requests;

use App\Enums\Role;
use App\Enums\Sex;
use App\Rules\IsJson;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $routeName = $this->route()->getName();
        $todayDate = date('Y-m-d');

        return match ($routeName) {
            'users.store' => $this->getStoreUserRules($todayDate),
            'users.update' => $this->getUpdateUserRules($todayDate),
            default => []
        };
    }

    /**
     * User store rules
     */
    private function getStoreUserRules($todayDate): array
    {
        return [
            'email' => ['required', 'email', 'unique:users,email', 'max:255'],
            'password' => ['string', 'required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
            'first_name' => ['string', 'required', 'max:255'],
            'last_name' => ['string', 'required', 'max:255'],
            'middle_name' => ['nullable', 'max:255'],
            'mobile_number' => ['nullable', 'regex:/^(\+63)\d{10}$/'], // +639064647221
            'sex' => ['nullable', new Enum(Sex::class)],
            'birthday' => ['nullable', 'date_format:Y-m-d', 'before_or_equal:' . $todayDate],
            'home_address' => ['nullable', 'max:255'],
            'barangay' => ['nullable', 'max:255'],
            'city' => ['nullable', 'max:255'],
            'region' => ['nullable', 'max:255'],
            'profile_picture_url' => ['nullable', 'active_url', 'max:255'],
            'meta' => ['nullable', new IsJson()],
            'roles' => ['required', 'array'],
            'roles.*' => ['required', new Enum(Role::class)],
        ];
    }

    /**
     * User update rules
     */
    private function getUpdateUserRules($todayDate): array
    {
        return [
            'email' => ['nullable', 'email', 'max:255', 'unique:users,email,' . $this['id']],
            'first_name' => ['nullable', 'max:255'],
            'last_name' => ['nullable', 'max:255'],
            'middle_name' => ['nullable', 'max:255'],
            'mobile_number' => ['nullable', 'regex:/^(\+63)\d{10}$/'], // +639064647221
            'sex' => ['nullable', new Enum(Sex::class)],
            'birthday' => ['nullable', 'date_format:Y-m-d', 'before_or_equal:' . $todayDate],
            'home_address' => ['nullable', 'string', 'max:255'],
            'barangay' => ['nullable', 'max:255'],
            'city' => ['nullable', 'max:255'],
            'region' => ['nullable', 'max:255'],
            'profile_picture_url' => ['nullable', 'active_url', 'max:255'],
            'meta' => ['nullable', new IsJson()],
            'roles' => ['nullable', 'array'],
            'roles.*' => [new Enum(Role::class)],
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'mobile_number.regex' => 'The mobile_number field should follow this format: +63XXXXXXXXXX.',

            /** These are not working. Can't find it anywhere in Laravel 9 docs
             * @see https://laracasts.com/discuss/channels/laravel/laravel-9-enum-validation-custom-message
             */
            'sex.validation.enum' => 'Valid values are `male` and `female`.',
            'roles.*.enum' => 'Valid role values are `regular`, `security`, `medical`, and `health-officer`.',
        ];
    }
}
