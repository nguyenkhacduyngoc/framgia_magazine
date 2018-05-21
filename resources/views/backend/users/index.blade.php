@extends('backend.master')
@section('backend-content')
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-table"></i></h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="index.html"></a></li>
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
                            {!! trans('auth.user') !!}
                        </header>
                        <table class="table table-striped table-advance table-hover">
                            <tbody>
                            <tr>
                                <th><i class="icon_profile"></i> {!! trans('auth.fullname') !!}</th>
                                <th><i class="icon_profile"></i> {!! trans('auth.username') !!}</th>
                                <th><i class="icon_mail_alt"></i> {!! trans('auth.email') !!}</th>
                                <th><i class="icon_cog"></i> {!! trans('auth.role') !!}</th>
                                <th><i class="icon_profile"></i> {!! trans('auth.gender') !!}</th>
                                <th style="text-align: center"><i class="icon_cogs"></i> Action</th>
                            </tr>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->fullname }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->role == 1)
                                            {!! trans('auth.admin') !!}
                                        @else
                                            {!! trans('auth.user') !!}
                                        @endif
                                    </td>
                                    <td>{{ $user->gender }}</td>
                                    <td style="text-align: center">
                                        <div class="btn-group">
                                            {{-- <a class="btn btn-danger" href="{{ route('admin.users.destroy',['user' => $user]) }}">
                                            <i class="icon_close_alt2"></i></a> --}}
                                            {!! Form::open(['route' => ['admin.users.destroy', $user->id], 'action' => 'UserController@destroy', 'method' => 'delete']) !!}
                                            <a class="btn btn-primary"
                                               href="{{ route('admin.users.edit', ['user' => $user]) }}"><i
                                                        class="fa fa-pencil-square-o"></i></a>
                                            <a class="btn btn-success"
                                               href="{{ route('admin.users.show', ['user' => $user]) }}"><i
                                                        class="fa fa-eye"></i></a>
                                            {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </section>
                </div>
            </div>
            <!-- page end-->
        </section>
    </section>
@endsection
