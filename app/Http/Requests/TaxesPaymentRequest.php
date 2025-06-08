<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaxesPaymentRequest extends FormRequest {
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
            'user_id' => 'required|integer|exists:users,id',
            'individual_entrepreneur_type_id' => 'required|integer|exists:individual_entrepreneur_types,id',
            'tax_schema_id' => 'required|integer|exists:tax_schemas,id',
            'income' => 'required|decimal:0,2|min:0|max:999999999999999.99',
            'expenses' => 'required|decimal:0,2|min:0|max:999999999999999.99',
            'financial_operation_id' => [
                'required',
                'integer',
                'exists:financial_operations,id',
                Rule::unique('taxes_payments', 'financial_operation_id'),
            ],
        ];
    }
}
