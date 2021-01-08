<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status'
    ];

    protected $hidden = [

    ];

    const ACTIVE = 1;
    const INACTIVE = 0;
    const STATUS = [
        self::ACTIVE => "Active",
        self::INACTIVE => "In Active"
    ];

    /**
     * Poll Answers relationship
     * 
     * @return HasMany
     */
    public function pollAnswers()
    {
        return $this->hasMany(PollAnswer::class);
    }

    /**
     * Poll User
     * 
     * @return BelongsToMany
     */
    public function pollUser()
    {
        return $this->belongsToMany(User::class)->withPivot(
            [
                'answers'
            ]
        );
    }

    /**
     * Scope Answered polls
     * 
     * @param Builder $query Eloquent builder
     * 
     * @return Builder
     */
    public function scopeAnsweredPolls(Builder $query)
    {
        return $query->whereHas('pollUser', function ($userPoll) {
            return $userPoll->where('user_id', \Auth::id());
        });
    }

    /**
     * Scope Active polls
     * 
     * @param Builder $query Eloquent builder
     * 
     * @return Builder
     */
    public function scopeActivePolls(Builder $query)
    {
        return $query->whereDoesntHave('pollUser', function ($pollUser) {
            return $pollUser->where('user_id', \Auth::id());
        });
    }
}
