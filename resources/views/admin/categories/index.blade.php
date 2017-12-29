@extends('layouts.admin.main')

@section('title', 'SiteNews | Blog index')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Categories
                <small>Display All blog categories</small>
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
                        <div class="box-header">
                            <div class="pull-left">
                                <a href="{{ route('admin.categories.create') }}" class="btn btn-success">Add New</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body ">
                            @if (session('message'))
                                <div class="alert alert-info">
                                    {{ session('message') }}
                                </div>
                            @endif

                            @if (! $categories->count())
                                <div class="alert alert-danger">
                                    <strong>No record found</strong>
                                </div>
                            @else
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <td width="80">Action</td>
                                        <td width="40">Active</td>
                                        <td>Name</td>
                                        <td width="120">Slug</td>
                                        <td width="170">Date</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($categories as $category)

                                        <tr>
                                            <td>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['admin.categories.destroy', $category->id]]) !!}
                                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-xs btn-default">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="submit" class="btn btn-xs btn-danger">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                                {!! Form::close() !!}
                                            </td>
                                            <td>
                                                <input type="checkbox" name="is_active" {{$category->is_active == true ? e('checked') : false}} onclick="activeChange({{$category->id}})">
                                            </td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->slug }}</td>
                                            <td>
                                                <abbr title="{{ $category->dateFormatted(true) }}">{{ $category->dateFormatted() }}</abbr> |
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
                                {{ $categories->render() }}
                            </div>
                            <div class="pull-right">
                                <small>{{ $categoryCount }} {{ str_plural('Item', $categoryCount) }}</small>
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

            var url = "/admin/categories/activeChange/"+id;
            $.post(url, function (data) {
                renderTable(data);
            });
        }

        function renderTable(data) {

        }
    </script>
@endsection