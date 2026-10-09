<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'role',
        'phone_number',
        'photo',
        'birth_date',
        'is_subscribed',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birth_date' => 'datetime'
        ];
    }


    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function pricings(): HasMany
    {
        return $this->hasMany(Pricing::class);
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class, 'user_id')->where('status', true);
    }

    public function becomeManagerSubscriptions()
    {
        return $this->belongsToMany(Subscription::class, 'user_id')
            ->where('pricing_id', null)
            ->where('room_id', null)
            ->where('status', true);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function roomSubscriptions(): HasMany
    {
        return $this->HasMany(Subscription::class, 'user_id')
            ->whereNotNull('pricing_id')
            ->whereNotNull('room_id')
            ->where('status', true);
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    public function outfits(): HasMany
    {
        return $this->hasMany(Outfit::class);
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }
}
