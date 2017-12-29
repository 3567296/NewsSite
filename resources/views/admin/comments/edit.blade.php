@extends('layouts.admin.main')

@section('title', 'SiteNews | Edit post')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Comments
                <small>Edit Comment</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i>Dashboard</a>
                </li>
                <li><a href="{{ route('admin.comments.index') }}">Comments</a></li>
                <li class="active">Edit Comment</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body ">
                            {!! Form::model($comment, [
                                'method' => 'PUT',
                                'route' => ['admin.comments.update', $comment->id],
                                'id' => 'comment-form'
                            ]) !!}

                            <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                                {!! Form::label('body') !!}
                                {!! Form::textarea('body', null, ['class' => 'form-control']) !!}

                                @if ($errors->has('body'))
                                    <span class="help-block">{{ $errors->first('body') }}</span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('user_id') ? 'has-error' : '' }}">
                                {!! Form::label('user_id', 'User') !!}
                                {!! Form::select('user_id', App\User::pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => 'User']) !!}

                                @if ($errors->has('user_id'))
                                    <span class="help-block">{{ $errors->first('user_id') }}</span>
                                @endif
                            </div>

                            <hr>

                            {!! Form::submit('Update comment', ['class' => 'btn btn-primary']) !!}

                            {!! Form::close() !!}
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $('ul.pagination').addClass('no-margin pagination-sm');

        $('#draft-btn').click(function(e){
            e.preventDefault();
            $('#comment-form').submit();
        });
    </script>
@endsection