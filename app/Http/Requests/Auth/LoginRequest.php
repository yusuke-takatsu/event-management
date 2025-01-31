<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Data\Input\Auth\LoginInputData;
use App\Rules\PasswordPattern;
use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'max:255', 'email'],
            'password' => ['required', 'string', 'min:8', new PasswordPattern()],
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'email' => 'メールアドレス',
            'password' => 'パスワード',
        ];
    }

    /**
     * @return LoginInputData
     */
    public function makeData(): LoginInputData
    {
        return LoginInputData::from($this->validated());
    }
}
