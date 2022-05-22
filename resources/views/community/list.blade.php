<ul class="list-group">
    @if (count($links))
        @foreach ($links as $link)
            <div class="media text-muted pt-3 d-flex align-items-start">

                    <form method="POST" action="/votes/{{ $link->id }}">
                        @csrf
                        <button style="margin-right: 10px" class="btn btn-primary btn-sm  {{ Auth::check() && Auth::user()->votedFor($link) ? 'btn-success' : 'btn-default' }}" type="submit">
                            {{ $link->votes->count() }}
                        </button>
                    </form>



                <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray flex-grow-1 flex-shrink-1">
                    <strong class="d-block text-gray-dark">
                        Contributted By:
                        <a href="#">
                            {{ $link->creator->name }}
                        </a>
                        {{ $link->updated_at->diffForHumans() }}
                    </strong>

                    <a href="/community/{{ $link->channel->slug }}" class="badge badge-primary "
                        style="background: {{ $link->channel->color }}">
                        {{ $link->channel->title }}
                    </a>

                    <a target="_blank" href="{{ $link->link }}">
                        {{ $link->title }}
                    </a>



                </p>

            </div>
        @endforeach
    @else
        <li class="list-group-item">
            No contributions yet.
        </li>
    @endif
</ul>
{{ $links->appends(request()->query())->links() }}
