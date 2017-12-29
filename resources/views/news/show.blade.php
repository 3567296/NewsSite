    @extends('layouts.main')

    @section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                            <article class="post-item post-detail">
                                @if($post->image_url)
                                <div class="post-item-image">
                                    <img src="{{ $post->image_url }}" alt="{{ $post->name }}">
                                </div>
                                @endif

                                <div class="post-item-body">
                                    <div class="padding-10">
                                        <h1>{{ $post->name }}</h1>

                                        <div class="post-meta no-border">
                                            <ul class="post-meta-group" style="list-style-type: none">
                                                <li><i class="fa fa-clock-o"></i><time> {{ $post->date }}</time></li>
                                                <li><i class="fa fa-tag"></i>{!! $post->tags_html !!}</li>
                                            </ul>
                                        </div>
                                        <div>
                                            {!! $post->body !!}
                                        </div>
                                    </div>
                                </div>
                            </article>

                            <article class="post-author padding-10">
                                <div class="media">
                                  <div class="media-left">
                                    <span><b>by {{ $post->user->name }}</b></span>
                                  </div>
                                  <div class="media-body">
                                    <div class="post-author-count">
                                    </div>
                                  </div>
                                </div>
                            </article>

                            @include('news.comments')
                        </div>

        </div>
    </div>

    @endsection


