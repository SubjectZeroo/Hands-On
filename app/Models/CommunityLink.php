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

    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public static function from(User $user)
    {
        $link = new static;

        $link->user_id = $user->id;

        return $link;
    }

    public function contribute($attributes)
    {
        return $this->fill($attributes)->save();
    }
}
