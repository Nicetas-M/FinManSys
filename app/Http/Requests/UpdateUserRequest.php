<?php

namespace App\Http\Requests;

use App\Traits\RequestFailedValidation;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest {
    use RequestFailedValidation;

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
            'name' => 'required|string|max:255',
            'email' => [
                'email',
                Rule::unique('users', 'email')->ignore($this->user),
            ],
            'password' => 'required|string|min:8',
        ];
    }
}
