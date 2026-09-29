<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'amount',
        'display_order',
    ];

    public function receiptDetails(): HasMany
    {
        return $this->hasMany(ReceiptDetail::class);
    }
}
