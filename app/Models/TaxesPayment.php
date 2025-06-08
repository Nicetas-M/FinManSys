<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TaxesPayment extends Model
{
    use HasFactory;

    protected $table = 'taxes_payments';

    protected $guarded = [];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function individualEntrepreneurType(): BelongsTo {
        return $this->belongsTo(IndividualEntrepreneurType::class, 'individual_entrepreneur_type_id', 'id');
    }

    public function taxSchema(): BelongsTo {
        return $this->belongsTo(TaxSchema::class, 'tax_schema_id', 'id');
    }

    public function financialOperation(): HasOne {
        return $this->hasOne(FinancialOperation::class, 'financial_operation_id', 'id');
    }
}
