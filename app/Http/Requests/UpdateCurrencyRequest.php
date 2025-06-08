<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCurrencyRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'alfa-3' => [
                'required',
                'max:3',
                'min:3',
                'string',
                Rule::unique('currencies', 'alfa-3')->ignore($this->currency),
            ],
            'number-3' => [
                'required',
                'digits:3',
                'numeric',
                Rule::unique('currencies', 'number-3')->ignore($this->currency),
            ],
            'name' => 'required',
        ];
    }
}
