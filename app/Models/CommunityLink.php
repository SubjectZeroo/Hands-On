<?php

namespace App\Models;

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
        return $this->fill($attributes)->save();
    }

    public function approved()
    {
        $this->approved = true;

        return $this;
    }

    public function creator()
    {
        return $this->belongsTo(User::class);
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
}
