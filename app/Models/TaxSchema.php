<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TaxSchema extends Model
{
    use HasFactory;

    protected $table = 'tax_schemas';

    protected $guarded = [];

    public function taxTypes(): BelongsToMany {
        return $this->belongsToMany(
            TaxType::class,
            'tax_schemas_compositions',
            'tax_schema_id',
            'tax_type_id'
        );
    }
}
