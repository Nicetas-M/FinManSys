<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FinancialOperation extends Model
{
    use HasFactory;

    protected $table = 'financial_operations';

    public function taxesPayments(): HasOne {
        return $this->hasOne(TaxesPayment::class, 'financial_operation_id', 'id');
    }

    public function userAccount(): BelongsTo {
        return $this->belongsTo(UserAccount::class, 'user_account_id', 'id');
    }

}
