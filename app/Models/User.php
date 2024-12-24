<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Builder;
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
        'gender',
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
        return $this->defineBaseFriendRequestRelationship('from', 'to')
            ->wherePivotNull('accepted_at')
            ->wherePivotNull('refused_at');
    }

    public function receivedFriendRequests(): BelongsToMany
    {
        return $this->defineBaseFriendRequestRelationship('to', 'from')
            ->wherePivotNull('accepted_at')
            ->wherePivotNull('refused_at');
    }

    public function sentFriendsAccepted(): BelongsToMany
    {
        return $this->defineBaseFriendRequestRelationship('from', 'to')
            ->wherePivotNotNull('accepted_at');
    }

    public function receivedFriendsAccepted(): BelongsToMany
    {
        return $this->defineBaseFriendRequestRelationship('to', 'from')
            ->wherePivotNotNull('accepted_at');
    }

    public function sentBaseFriendRequests(): BelongsToMany
    {
        return $this->defineBaseFriendRequestRelationship('from', 'to');
    }

    public function receivedBaseFriendRequests(): BelongsToMany
    {
        return $this->defineBaseFriendRequestRelationship('to', 'from');
    }

    public function friends(): \Staudenmeir\LaravelMergedRelations\Eloquent\Relations\MergedRelation
    {
        return $this->mergedRelation('friends');
    }

    public function scopePotentialFriends(Builder $query, int $userId)
    {
        $query->whereNot('users.id', $userId)
            ->whereDoesntHave('sentBaseFriendRequests', fn ($query) => $query->where('to', $userId))
            ->whereDoesntHave('receivedBaseFriendRequests', fn ($query) => $query->where('from', $userId));
    }

    private function defineBaseFriendRequestRelationship(string $foreign, string $related): BelongsToMany
    {
        return $this->belongsToMany(self::class, 'friend_requests', $foreign, $related)
            ->withPivot('accepted_at', 'refused_at')
            ->withTimestamps();
    }
}
