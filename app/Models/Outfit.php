<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Outfit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'sale_price',
        'currency',
        'cover_image',
        'status',
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

    public function scopeAddedByManager($query, $managerId)
    {
        return $query->where('user_id', $managerId);
    }
}
