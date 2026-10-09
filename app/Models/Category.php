<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'parent_id',
        'name',
        'amount',
        'display_order',
    ];

    /**
     * Get the parent category.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Get all subcategories under this category.
     */
    public function subcategories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')
            ->orderBy('display_order');
    }

    /**
     * Get receipt details for this category.
     */
    public function receiptDetails(): HasMany
    {
        return $this->hasMany(ReceiptDetail::class);
    }
}
