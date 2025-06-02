<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Currency extends Model
{
    use HasFactory;

    protected $table = 'currencies';

    protected $guarded = [];

    public function usersAccounts(): HasMany {
        return $this->hasMany(UserAccount::class, 'currency_id', 'id');
    }
}
