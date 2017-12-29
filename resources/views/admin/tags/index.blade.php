@extends('layouts.admin.main')

@section('title', 'SiteNews | Blog index')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Tags
                <small>Display All blog tags</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i>Dashboard</a>
                </li>
                <li><a href="{{ route('admin.tags.index') }}">Tags</a></li>
                <li class="active">All Tags</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="pull-left">
                                <a href="{{ route('admin.tags.create') }}" class="btn btn-success">Add New</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body ">
                            @if (session('message'))
                                <div class="alert alert-info">
                                    {{ session('message') }}
                                </div>
                            @endif

                            @if (! $tags->count())
                                <div class="alert alert-danger">
                                    <strong>No record found</strong>
                                </div>
                            @else
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <td width="80">Action</td>
                                        <td>Name</td>
                                        <td width="120">Slug</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($tags as $tag)

                                        <tr>
                                            <td>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['admin.tags.destroy', $tag->id]]) !!}
                                                <a href="{{ route('admin.tags.edit', $tag->id) }}" class="btn btn-xs btn-default">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="submit" class="btn btn-xs btn-danger">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                                {!! Form::close() !!}
                                            </td>
                                            <td>{{ $tag->name }}</td>
                                            <td>{{ $tag->slug }}</td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                            <div class="pull-left">
                                {{ $tags->render() }}
                            </div>
                            <div class="pull-right">
                                <small>{{ $tagCount }} {{ str_plural('Item', $tagCount) }}</small>
                            </div>
                        </div>
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
    </script>
@endsection