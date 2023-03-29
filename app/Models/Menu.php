<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name', 'product_description', 'product_image', 'product_price'
    ];

    public function categories(): BelongsTo
    {
        return $this->belongsTo(
            \App\Models\Category::class,
            'category_id'

        );
    }

    public function foodaddons(): HasMany
    {
        return $this->hasMany(
            \App\Models\Foodaddon::class,
            'menu_id'

        );
    }

    public function orderdetails(): HasMany
    {
        return $this->hasMany(
            \App\Models\Orderdetail::class,
            'menu_id'

        );
    }
}
