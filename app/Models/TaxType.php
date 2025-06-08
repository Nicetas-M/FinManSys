<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TaxType extends Model
{
    use HasFactory;

    protected $table = 'tax_types';

    protected $guarded = [];

    public function taxSchemas(): BelongsToMany {
        return $this->belongsToMany(
            TaxSchema::class,
            'tax_schemas_compositions',
            'tax_type_id',
            'tax_schema_id'
        );
    }
}
