@extends('layouts.admin.main')

@section('title', 'SiteNews | Edit post')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Categories
                <small>Edit category</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i>Dashboard</a>
                </li>
                <li><a href="{{ route('admin.categories.index') }}">Categories</a></li>
                <li class="active">All Categories</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body ">
                            {!! Form::model($category, [
                                'method' => 'PUT',
                                'route' => ['admin.categories.update', $category->id],
                                'files' => TRUE,
                                'id' => 'category-form'
                            ]) !!}

                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                {!! Form::label('name') !!}
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}

                                @if ($errors->has('name'))
                                    <span class="help-block">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                                {!! Form::label('slug') !!}
                                {!! Form::text('slug', null, ['class' => 'form-control']) !!}

                                @if ($errors->has('slug'))
                                    <span class="help-block">{{ $errors->first('slug') }}</span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('access_id') ? 'has-error' : '' }}">
                                {!! Form::label('access_id', 'Access') !!}
                                {!! Form::select('access_id', App\Access::pluck('status_name', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Choose access rights']) !!}

                                @if ($errors->has('access_id'))
                                    <span class="help-block">{{ $errors->first('access_id') }}</span>
                                @endif
                            </div>

                            <hr>

                            {!! Form::submit('Update post', ['class' => 'btn btn-primary']) !!}

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

        $('#title').on('blur', function(){
            var theTitle = this.value.toLowerCase().trim(),
                slugInput = $('#slug'),
                theSlug = theTitle.replace(/&/g, '-and-')
                    .replace(/[^a-z0-9-]+/g, '-')
                    .replace(/\-\-+/g, '-')
                    .replace(/^-+|-+$/g, '');

            slugInput.val(theSlug);
        });

        var simplemde1 = new SimpleMDE({ element: $("#body")[0] });


        $('#draft-btn').click(function(e){
            e.preventDefault();
            $('#category-form').submit();
        });
    </script>
@endsection