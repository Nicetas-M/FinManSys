<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaxesPaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'individual_entrepreneur_type_id' => $this->individual_entrepreneur_type_id,
            'tax_schema_id' => $this->tax_schema_id,
            'income' => $this->income,
            'expenses' => $this->expenses,
            'financial_operation_id' => $this->financial_operation_id,
        ];
    }
}
