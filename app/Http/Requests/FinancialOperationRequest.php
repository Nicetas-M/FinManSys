<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinancialOperationRequest extends FormRequest {
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
            'user_account_id' => 'required|exists:users,id',
            'balance_change' => 'required|decimal:0,2|min:0|max:999999999999999.99',
            'balance_after' => 'required|decimal:0,2|min:0|max:999999999999999.99',
        ];
    }
}
