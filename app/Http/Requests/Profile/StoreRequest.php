<?php

namespace App\Http\Requests\Profile;

use App\Data\Input\Profile\StoreInputData;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'nick_name' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date', 'date_format:Y-m-d', 'before_or_equal:today'],
            'fishing_started_date' => ['required', 'date', 'date_format:Y-m-d', 'before_or_equal:today'],
            'image' => ['nullable', 'string', 'file', 'mimes:jpg,jpeg,ping', 'max:3072'],
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'nick_name' => 'ニックネーム',
            'date_of_birth' => '誕生日',
            'fishing_started_date' => '釣りを始めた日',
            'image' => 'アイコン画像',
        ];
    }

    /**
     * @return StoreInputData
     */
    public function makeData(): StoreInputData
    {
        return StoreInputData::from($this->validated());
    }
}
