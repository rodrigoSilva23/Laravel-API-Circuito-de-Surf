<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use function GuzzleHttp\Promise\all;

class UpdateSurferRequest extends FormRequest
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
            "name" => "nullable|string|max:100|min:3",
            "country" => "nullable|string|min:3|max:100",
        ];
    }
}
