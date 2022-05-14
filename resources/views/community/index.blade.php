@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>Community</h1>
                <ul>
                    @foreach ($links as $link)
                        <li class="">
                            <a target="_blank" href="{{ $link->link }}">{{ $link->title }}</a>
                            <small>Contributted By: <a href="#">{{ $link->creator->name }}</a>   {{ $link->updated_at->diffForHumans() }}</small>
                        </li>
                    @endforeach
                </ul>
            </div>
           @include('community.add-link')
        </div>
    </div>
@endsection
