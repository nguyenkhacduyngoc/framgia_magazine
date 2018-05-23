@extends('backend.master')
@section('backend-content')
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-table"></i></h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href=""></a></li>
                        <li><i class="fa fa-table"></i></li>
                        <li><i class="fa fa-th-list"></i></li>
                    </ol>
                </div>
            </div>
            <!-- page start-->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            {!! trans('admin.posts') !!}
                        </header>
                        <table class="table table-striped table-advance table-hover">
                            <tbody>
                            <tr>
                                <th><i class="fa fa-pencil"></i> {!! trans('admin.title') !!} </th>
                                <th><i class="fa fa-star"></i> {!! trans('admin.status') !!} </th>
                                <th><i class="fa fa-archive"></i> {!! trans('admin.category') !!} </th>
                                <th><i class="fa fa-user"></i> {!! trans('admin.user') !!} </th>
                                <th><i class="fa fa-clock-o"></i> {!! trans('admin.created_at') !!} </th>
                                <th style="text-align: center"><i class="fa fa-cogs"></i> {!! trans('admin.action') !!}
                                </th>
                            </tr>
                            @foreach($posts as $post)
                                <tr>
                                    <td id="table-title"> {!! substr($post->title, 0, 50) !!}{!! strlen($post->title) > 50 ? "...": "" !!} </td>
                                    <td>
                                        @if($post->status ==0)
                                            <label for="" class="label label-danger"> {!! trans('admin.rejected') !!} </label>
                                        @elseif($post->status==1)
                                            <label for="" class="label label-warning"> {!! trans('admin.pending') !!} </label>
                                        @else
                                            <label for="" class="label label-success"> {!! trans('admin.accepted') !!} </label>
                                        @endif
                                    </td>
                                    <td id="table-category">{!! ($post->category ==null) ? null : $post->category->name !!}</td>
                                    <td id="table-user">{{ $post->user->fullname }}</td>
                                    <td>{{ $post->created_at }}</td>
                                    <td style="text-align: center" class="">
                                        <div class="btn-group">
                                            {!! Form::open(['route' => ['admin.posts.destroy', $post->slug], 'action' => 'PostController@destroy', 'method' => 'delete']) !!}
                                            <a class="btn btn-primary"
                                               href="{{ route('admin.posts.edit', ['post' => $post]) }}"><i class="fa fa-pencil-square-o"></i></a>
                                            <a class="btn btn-success"
                                               href="{{ route('admin.posts.show', ['post' => $post]) }}"><i class="fa fa-eye"></i></a>
                                            {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $posts->links() }}
                    </section>
                </div>
            </div>
            <!-- page end-->
        </section>
    </section>
@endsection
