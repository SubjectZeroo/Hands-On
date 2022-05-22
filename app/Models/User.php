<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isTrusted()
    {
        return !! $this->trusted;
    }

    public function votes()
    {
        return $this->belongsToMany(CommunityLink::class, 'community_links_votes')->withTimestamps();
    }

    public function toggleVoteFor(CommunityLink $link){
        CommunityLinkVote::firstOrNew([
            'user_id' => $this->id,
            'community_link_id' => $link->id
        ])->toggle();
    }

    // public function voteFor(CommunityLink $link)
    // {
    //     // return $link->votes()->create(['user_id' => $this->id]);
    //     return $this->votes()->sync([$link->id], false);
    // }

    // public function unVoteFor(CommunityLink $link)
    // {
    //     // return $link->votes()->create(['user_id' => $this->id]);
    //     return $this->votes()->detach($link);
    // }

    public function votedFor(CommunityLink $link)
    {
        return $link->votes->contains('user_id', $this->id);
    }
}
