<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'site_url',
        'cover_image',
        'overview_image',
        'status',
        'user_id',
        'longitude',
        'latitude',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function outfits(): BelongsToMany
    {
        return $this->belongsToMany(Outfit::class);
    }

    public function pricings(): BelongsToMany
    {
        return $this->belongsToMany(Pricing::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function scopeAddedByManager($query, $managerId)
    {
        return $query->where('user_id', $managerId);
    }
}
