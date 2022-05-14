<div class="col-md-4">
    <h3>Contribute a link</h3>
    <div class="card">
        {{-- <div class="card-header"></div> --}}
        <div class="card-body">
            <form method="POST" action="/community">
                @csrf
                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title"  name="title" placeholder="What is the title of your article?">
                    {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group  {{ $errors->has('link') ? 'has-error' : '' }}">
                    <label for="link">Link</label>
                    <input type="text" class="form-control" id="link" name="link" placeholder="What is the URL?">
                    {!! $errors->first('link', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group">
                    <button class="btn btn-primary"></button>
                </div>
            </form>
        </div>
    </div>
</div>
