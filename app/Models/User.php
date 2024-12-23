<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Staudenmeir\LaravelMergedRelations\Eloquent\HasMergedRelationships;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasMergedRelationships;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
        ];
    }

    public function sentFriendRequests(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friend_requests', 'from', 'to')
            ->wherePivotNull('accepted_at')
            ->wherePivotNull('refused_at')
            ->withTimestamps();
    }

    public function receivedFriendRequests(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friend_requests', 'to', 'from')
            ->wherePivotNull('accepted_at')
            ->wherePivotNull('refused_at')
            ->withTimestamps();
    }

    public function sentFriendsAccepted(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friend_requests', 'from', 'to')
            ->wherePivotNotNull('accepted_at')
            ->withTimestamps();
    }

    public function receivedFriendAccepted(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friend_requests', 'to', 'from')
            ->wherePivotNotNull('accepted_at')
            ->withTimestamps();
    }

    public function friends(): \Staudenmeir\LaravelMergedRelations\Eloquent\Relations\MergedRelation
    {
        return $this->mergedRelation('friends');
    }

}
