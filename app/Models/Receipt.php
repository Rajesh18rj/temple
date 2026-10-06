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
        'receipt_number',
        'receipt_type',
        'city_id',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function receiptDetails(): HasMany
    {
        return $this->hasMany(ReceiptDetail::class);
    }
}
