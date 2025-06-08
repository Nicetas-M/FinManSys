<?php

namespace App\Http\Requests;

use App\Traits\RequestFailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class StoreCurrencyRequest extends FormRequest
{
    use RequestFailedValidation;

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
            'alfa-3' => 'required|max:3|min:3|string|unique:currencies,alfa-3',
            'number-3' => 'required|digits:3|numeric|unique:currencies,number-3',
            'name' => 'required',
        ];
    }
}
