<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    public function company(): BelongsTo {
        return $this->belongsTo(Company::class);
    }

    public function lineItems(): HasMany {
        return $this->hasMany(LineItem::class);
    }

    public function getTotalAttribute() {
        return $this->lineItems->reduce(function($accum, $item) {
            return $accum + $item->amount;
        }, 0);
    }
}
