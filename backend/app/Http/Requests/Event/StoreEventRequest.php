<?php

declare(strict_types=1);

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'event_date' => ['required', 'date', 'date_format:Y-m-d', 'after_or_equal:today', 'before_or_equal:+5 years'],
            'event_time' => ['required', 'date_format:H:i'],
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'title' => __('event.title'),
            'description' => __('event.description'),
            'location' => __('event.location'),
            'event_date' => __('event.event_date'),
            'event_time' => __('event.event_time'),
        ];
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return [
            'title' => $this->input('title'),
            'description' => $this->input('description'),
            'location' => $this->input('location'),
            'event_date' => $this->input('event_date'),
            'event_time' => $this->input('event_time'),
        ];
    }
}
