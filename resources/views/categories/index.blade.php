    @extends('layouts.main')

    @section('content')

    @include('common.slider')

        <div class="container text-center">
            <h3>What We Do</h3><br>
            <div class="row">

                <div class="col-sm-2">
                    <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
                    <p>Current Project</p>
                </div>

                <div class="col-sm-8">

                    @foreach ($categories as $category)

                        <h1>{{ $category->name }}</h1>

                        @foreach ($category->posts->slice(0, 5) as $post)

                            <article class="post-item">
                                @if ($post->image_url)
                                    <div class="post-item-image">
                                        <a href="{{ route('web.news.show', $post->slug) }}">
                                            <img src="{{ $post->image_url }}" alt="">
                                        </a>
                                    </div>
                                @else
                                    <div class="post-item-image">
                                        <img src="/img/Post_Image_1.jpg" alt="">
                                    </div>
                                @endif

                                <div class="post-item-body">
                                    <div class="padding-10">
                                        <h2><a href="{{ route('web.news.show', $post->slug) }}">{{ $post->name }}</a></h2>
                                    </div>

                                    <div class="post-meta padding-10 clearfix">
                                        <div class="pull-left">
                                            <ul class="post-meta-group">
                                            </ul>
                                        </div>
                                        <div class="pull-right">
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div><br>
    @endsection
