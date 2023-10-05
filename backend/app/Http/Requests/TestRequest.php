<?php

namespace App\Http\Requests;

use App\DataTransferObjects\Post;
use App\Enums\PostStatus;
use Illuminate\Foundation\Http\FormRequest;
use BenSampo\Enum\Rules\EnumValue;
use Spatie\LaravelData\WithData;

class TestRequest extends FormRequest
{
    use WithData;

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
          'title' => ['required', 'string'],
          'content' => ['required', 'string'],
          'status' => ['required', new EnumValue(PostStatus::class)],
          'published_at' => ['nullable', 'date'],
        ];
    }

    protected function dataClass(): string
    {
        return Post::class;
    }
}
