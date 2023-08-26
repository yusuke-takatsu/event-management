<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Rules\AlphaNumSymbol;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'email:strict,dns,spoof', 'max:255', new AlphaNumSymbol()],
            'password' => ['required', 'string', 'min:8', 'max:255', new AlphaNumSymbol(), Password::default()],
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'email' => __('user.email'),
            'password' => __('user.password'),
        ];
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->only(['email', 'password']);
    }
}
