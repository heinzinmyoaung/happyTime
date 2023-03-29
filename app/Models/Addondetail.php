<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Addondetail extends Model
{
    use HasFactory;
    public function addons(): BelongsTo
    {
        return $this->belongsTo(
            \App\Models\Addon::class,
            'addon_id'

        );
    }
}
