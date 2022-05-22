<?php
namespace App\Queries;

use App\Models\CommunityLink;

class CommunityLinksQuery
{

    public function get($channel, $sortByPopular)
    {
        $orderBy = $sortByPopular ? 'votes_count' : 'updated_at';

      return  CommunityLink::with( 'creator', 'channel')
        ->withCount('votes')
        ->forChannel($channel)
        ->where('approved', 1)
        ->leftJoin('community_links_votes','community_links_votes.community_link_id', '=','community_links.id')
        ->orderBy($orderBy, 'desc')
        ->paginate(25);
    }
}
