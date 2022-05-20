@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3>Community</h3>
                <ul class="list-group">
                    @if (count($links))
                        @foreach ($links as $link)
                            <span class="badge badge-primary mr-2"
                                style="background: {{ $link->channel->color }}">
                                {{ $link->channel->title }}
                            </span>
                            <li class="list-group-item">
                                <a target="_blank" href="{{ $link->link }}">{{ $link->title }}</a>
                                <small>Contributted By: <a href="#">{{ $link->creator->name }}</a>   {{ $link->updated_at->diffForHumans() }}</small>
                            </li>
                        @endforeach
                    @else
                            <li class="list-group-item">
                                No contributions yet.
                            </li>
                    @endif
                </ul>
            </div>
           @include('community.add-link')
        </div>
    </div>
@endsection
