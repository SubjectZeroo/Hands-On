<?php

namespace App\Http\Controllers;

use App\Models\CommunityLink;
use App\Models\CommunityLinkVote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CommunityLink $link)
    {
        // auth()->user()->votes()->toggle($link);
        // $user = auth()->user();

        // $toggleVoteFor = $user->votedFor($link) ? 'unvoteFor' : 'voteFor';

        // $user->toggleVoteFor($link);

        // if($user->votedFor($link)) {
        //     $user->unvoteFor($link);
        // }else {
        //     $user->voteFor($link);
        // }

        // CommunityLinkVote::firstOrNew([
        //     'user_id' => auth()->id(),
        //     'community_link_id' => $link->id
        // ])->toggle();

        auth()->user()->toggleVoteFor($link);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
