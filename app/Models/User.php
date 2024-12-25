<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Staudenmeir\LaravelMergedRelations\Eloquent\HasMergedRelationships;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasMergedRelationships, Notifiable;

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

    public function receivedPendingFriends(): BelongsToMany
    {
        return $this->baseFriends('to', 'from')
            ->wherePivotNull('accepted_at')
            ->wherePivotNull('rejected_at');
    }

    public function fromPendingFriends(): BelongsToMany
    {
        return $this->baseFriends('from', 'to')
            ->wherePivotNull('accepted_at')
            ->wherePivotNull('rejected_at');
    }

    public function receivedAcceptedFriends(): BelongsToMany
    {
        return $this->baseFriends('to', 'from')->wherePivotNotNull('accepted_at');
    }

    public function fromAcceptedFriends(): BelongsToMany
    {
        return $this->baseFriends('from', 'to')->wherePivotNotNull('accepted_at');
    }

    public function receivedBaseFriends(): BelongsToMany
    {
        return $this->baseFriends('to', 'from');
    }

    public function fromBaseFriends(): BelongsToMany
    {
        return $this->baseFriends('from', 'to');
    }

    public function friends(): \Staudenmeir\LaravelMergedRelations\Eloquent\Relations\MergedRelation
    {
        return $this->mergedRelation('friends');
    }

    public function scopePotentialFriends($query): void
    {
        $userId = auth()->id();

        $query->whereNot('id', $userId)
            ->whereDoesntHave('receivedBaseFriends', fn ($query) => $query->where('from', $userId))
            ->whereDoesntHave('fromBaseFriends', fn ($query) => $query->where('to', $userId));
    }

    private function baseFriends(string $foreign, string $related): BelongsToMany
    {
        return $this->belongsToMany(self::class, 'friend_requests', $foreign, $related)
            ->withPivot('accepted_at', 'rejected_at')
            ->withTimestamps();
    }
}
