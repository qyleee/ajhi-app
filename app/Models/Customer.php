<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['customer_code', 'token', 'name', 'wa', 'alamat', 'plate', 'model'])]
class Customer extends Model
{
    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }
}
