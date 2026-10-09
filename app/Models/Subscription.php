<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'expiration_date',
        'status',
        'transaction_id',
        'pricing_id',
        'room_id',
        'user_id',
    ];



    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }
    
    public function pricing(): BelongsTo
    {
        return $this->belongsTo(Pricing::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSubscriber($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
