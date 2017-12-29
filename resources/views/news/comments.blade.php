<article class="post-comments" id="post-comments">
    {{--<h3><i class="fa fa-comments"></i> {{ $post->commentsNumber('Comment') }}</h3>--}}

    <div class="comment-body padding-10">
        <ul class="comments-list" style="list-style-type: none">
            @foreach ($comments as $comment)
            <li class="comment-item">
                <div class="comment-heading clearfix">
                    <div class="comment-author-meta">
                        <h4>{{ $comment->author->name }}
                            <small>{{ $comment->dateFormatted() }}</small>
                        </h4>
                    </div>
                </div>
                <div class="comment-content">
                    {!! $comment->body !!}
                </div>
                <hr />
            </li>
            @endforeach
        </ul>

        <nav>
            {!! $comments->links() !!}
        </nav>
    </div>

    <div class="comment-footer padding-10">
        @if ($errors->has('message'))
            <span class="help-block">
                <strong>{{ $errors->first('message') }}</strong>
            </span>
        @endif
        @guest
            <h2>To leave a comment you need to be logged in</h2>
        @else

        <h3>Leave a comment</h3>

        @if (session('message'))
            <div class="alert alert-info">
                {{ session('message') }}
            </div>
        @endif

        {!! Form::open(['route' => ['web.news.comments', $post->slug]]) !!}
            <div class="form-group required {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Name</label>
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group required {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">Email</label>
                {!! Form::text('email', null, ['class' => 'form-control']) !!}
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group required {{ $errors->has('body') ? 'has-error' : '' }}">
                <label for="comment">Comment</label>
                {!! Form::textarea('body', null, ['row' => 6, 'class' => 'form-control']) !!}
                @if ($errors->has('body'))
                    <span class="help-block">
                        <strong>{{ $errors->first('body') }}</strong>
                    </span>
                @endif
            </div>
            <div class="clearfix">
                <div class="pull-left">
                    <button type="submit" class="btn btn-lg btn-success">Submit</button>
                </div>
                <div class="pull-right">
                    <p class="text-muted">
                        <span class="required">*</span>
                        <em>Indicates required fields</em>
                    </p>
                </div>
            </div>
        {!! Form::close() !!}
    @endguest
    </div>

</article>