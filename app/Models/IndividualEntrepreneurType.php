<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IndividualEntrepreneurType extends Model
{
    use HasFactory;

    protected $table = 'individual_entrepreneur_types';

    protected $guarded = [];

    public function taxesPayments(): HasMany {
        return $this->hasMany(TaxesPayment::class, 'individual_entrepreneur_type_id', 'id');
    }
}
