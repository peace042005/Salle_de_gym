<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'amount',
        'amount_ttc',
        'option',
        'outfit_quantity',
        'currency',
        'status',
        'pricing_id',
        'room_id',
        'outfit_id',
        'user_id',
    ];


    public function pricing(): BelongsTo
    {
        return $this->belongsTo(Pricing::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function outfit(): BelongsTo
    {
        return $this->belongsTo(Outfit::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
