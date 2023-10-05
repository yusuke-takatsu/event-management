<?php

declare(strict_types=1);

namespace App\Http\Requests\Participation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class FetchParticipationDownloadCsvRequest extends FormRequest
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
            'csv_file' => [
                'required',
                'max:1024',
                'file',
                'mimes:csv,txt',
            ],
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
      return [
          'csv_file' => __('csv_file')
      ];
    }

    /**
     * @return UploadedFile
     */
    public function getCsvFile(): UploadedFile
    {
        return $this->file('csv_file');
    }
}
