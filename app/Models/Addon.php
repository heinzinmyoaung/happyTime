<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Addon extends Model
{
    use HasFactory;

    public function foodaddons(): HasMany
    {
        return $this->hasMany(
            \App\Models\Foodaddon::class,
            'addon_id'

        );
    }
    public function addondetails(): HasMany
    {
        return $this->hasMany(
            \App\Models\Addondetail::class,
            'addon_id'

        );
    }
}
