<?php

namespace App\Models;

use App\Exceptions\CommunityLinkAlreadySubmitted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CommunityLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'channel_id', 'title', 'link'
    ];

    public static function from(User $user)
    {
        $link = new static;

        $link->user_id = $user->id;

        if ($user->isTrusted()) {
            $link->approved();
        }

        return $link;

        // return new static(['user_id' => $user->id]);
    }



    public function contribute($attributes)
    {
        if($existing = $this->hasAlreadyBeenSubmitted($attributes['link'])) {
             $existing->touch();

             throw new CommunityLinkAlreadySubmitted;

        }
        return $this->fill($attributes)->save();
    }

    public function scopeForChannel($builder, $channel)
    {
        if($channel->exists) {
            return $builder->where('channel_id', $channel->id);
        }
        return $builder;
    }

    public function approved()
    {
        $this->approved = true;

        return $this;
    }

    public function creator()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function votes()
    {
        return $this->hasMany(CommunityLinkVote::class, 'community_link_id');
    }

    /**
     * Get the user that owns the CommunityLink
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    /**
     * Determinate if the link has already been submitted.
     *
     * @param string $link
     * @return boolean
     */
    protected function hasAlreadyBeenSubmitted($link)
    {
        return static::where('link', $link)->first();
    }
}
