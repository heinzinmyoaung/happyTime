<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Orderdetail extends Model
{
    use HasFactory;
    protected $fillable = ['orderdetails_quantity', 'orderdetails_totalprice', 'order_id', 'menu_id'];

    public function orders(): BelongsTo
    {
        return $this->belongsTo(
            \App\Models\Order::class,
            'order_id'

        );
    }

    public function menus(): BelongsTo
    {
        return $this->belongsTo(
            \App\Models\Menu::class,
            'menu_id'

        );
    }
}
