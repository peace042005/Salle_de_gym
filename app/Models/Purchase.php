<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'outfit_quantity',
        'status',
        'transaction_id',
        'outfit_id',
        'user_id',
    ];


    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
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
