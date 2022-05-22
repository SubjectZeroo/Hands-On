@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h6 class="border-bottom border-gray pb-2 mb-0"> Community</h6>
                {{-- <h3>
                    <a href="/community">

                    </a>
                    @if ($channel->exists)
                        <span>$mdash; {{ $channel->title }}</span>
                    @endif
                </h3> --}}
                <ul class="nav nav-tabs">
                    <li class="nav-item ">
                        <a class="nav-link {{ request()->exists('popular') ? '' : 'active' }}" href="{{ request()->url() }}">Most Recent</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{ request()->exists('popular') ? 'active' : '' }}" href="?popular">Most Popular</a>
                    </li>
                </ul>
                @include('community.list')
            </div>
           @include('community.add-link')
        </div>
    </div>
@endsection
