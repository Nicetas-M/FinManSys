<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserAccount extends Model {
    use HasFactory;

    protected $table = 'users_accounts';

    protected $guarded = [];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function currency(): BelongsTo {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    public function financialOperations(): HasMany {
        return $this->hasMany(FinancialOperation::class, 'user_account_id', 'id');
    }
}
