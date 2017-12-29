@extends('layouts.admin.main')

@section('title', 'SiteNews | Blog index')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Comments
                <small>Display All Comments</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i>Dashboard</a>
                </li>
                <li><a href="{{ route('admin.comments.index') }}">Comments</a></li>
                <li class="active">All Comments</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="pull-left">
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body ">
                            @if (session('message'))
                                <div class="alert alert-info">
                                    {{ session('message') }}
                                </div>
                            @endif

                            @if (! $comments->count())
                                <div class="alert alert-danger">
                                    <strong>No record found</strong>
                                </div>
                            @else
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <td width="80">Action</td>
                                        <td width="120">Author</td>
                                        <td>Text</td>
                                        <td width="120">Carma</td>
                                        <td width="120">Posted</td>
                                        <td width="170">Date</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($comments as $comment)
                                        <tr>
                                            <td>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['admin.comments.destroy', $comment->id]]) !!}
                                                <a href="{{ route('admin.comments.edit', $comment->id) }}" class="btn btn-xs btn-default">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="submit" class="btn btn-xs btn-danger">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                                {!! Form::close() !!}
                                            </td>
                                            <td>{{ optional($comment->author)->name }}</td>
                                            <td>{{ str_limit($comment->body, 150) }}</td>
                                            <td>{{ $comment->rating }}</td>
                                            <td><input type="checkbox" name="is_active" {{$comment->is_posted == true ? e('checked') : false}} onclick="activeChange({{$comment->id}})"></td>
                                            <td>
                                                <abbr title="{{ $comment->dateFormatted(true) }}">{{ $comment->dateFormatted() }}</abbr> |
                                            </td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                            <div class="pull-left">
                                {{ $comments->render() }}
                            </div>
                            <div class="pull-right">
                                <small>{{ $commentCount }} {{ str_plural('Item', $commentCount) }}</small>
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

    <script type="text/javascript">
        function activeChange(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var url = "/admin/comments/activeChange/"+id;
            $.post(url, function (data) {
                renderTable(data);
            });
        }

        function renderTable(data) {

        }
    </script>
@endsection