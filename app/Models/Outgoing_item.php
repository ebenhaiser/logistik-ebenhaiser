<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Outgoing_item extends Model
{
    protected $fillable = [
        'item_id',
        'quantity',
        'destination',
        'outgoing_date',
        'description',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
