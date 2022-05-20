<?php

namespace App\Http\Controllers;

use App\Exceptions\CommunityLinkAlreadySubmitted;
use App\Http\Requests\CommunityLinkRequest;
use App\Models\Channel;
use App\Models\CommunityLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityLinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = CommunityLink::where('approved', 1)->latest('updated_at')->paginate(25);
        $channels = Channel::orderBy('title', 'asc')->get();
        return view('community.index', compact('links', 'channels'));
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
    public function store(CommunityLinkRequest $request)
    {
        // $this->validate($request, [
        //     'channel_id' => 'required|exist:channels,id',
        //     'title' => 'required',
        //     'link' => 'required|active_url:unique:community_links'
        // ]);


        try {
            CommunityLink::from(auth()->user())
            ->contribute($request->all());

            if(auth()->user()->isTrusted()) {
                flash('Thanks!','Thanks for the contributions');
            }else {
                flash('Thanks!','This constributions will be approved shortly');
            }
        } catch (CommunityLinkAlreadySubmitted $e) {
           flash()->overlay(
        "We'll instead bump the timestamps and bring that link back to the top. Thanks",
            'That Link Has Already Been Submitted');
        }

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
