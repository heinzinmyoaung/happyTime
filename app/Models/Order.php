<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['TotalQuantity', 'TotalAmount'];

    public function orderdetails(): HasMany
    {
        return $this->hasMany(
            \App\Models\Orderdetail::class,
            'order_id'

        );
    }
}
