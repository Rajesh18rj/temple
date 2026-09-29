<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Receipt extends Model
{
    protected $fillable = [
        'name',
        'image',
        'mobile',
        'address',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function receiptDetails(): HasMany
    {
        return $this->hasMany(ReceiptDetail::class);
    }
}
