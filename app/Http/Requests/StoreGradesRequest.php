<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGradesRequest extends FormRequest
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
            'fk_wave' => 'required|numeric|exists:waves,id',
            'partial_grades1' => 'required|numeric|min:0|max:10',
            'partial_grades2' => 'required|numeric|min:0|max:10',
            'partial_grades3' => 'required|numeric|min:0|max:10'
        ];
    }
}
