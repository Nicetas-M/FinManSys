<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaxSchemaCompositionRequest extends FormRequest {
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
            'tax_schema_id' => 'required|exists:tax_schemas,id',
            'tax_type_id' => [
                'required',
                'exists:tax_types,id',
                Rule::unique('tax_schemas_compositions')->where(function ($query) {
                    return $query->where('tax_schema_id', $this->input('tax_schema_id'));
                })
            ],
        ];
    }
}
