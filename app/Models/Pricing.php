<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pricing extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'duration',
        'price',
        'currency',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class);
    }

    public function transactions(): BelongsToMany
    {
        return $this->belongsToMany(Transaction::class);
    }
}
