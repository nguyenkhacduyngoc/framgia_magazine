@extends('backend.master')
@section('backend-add-css')
{!! Html::style('css/frontend/dataTables.bootstrap4.min.css') !!}
@endsection
@section('backend-content')
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-table"></i> </h3>
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
                            {{ trans('admin.manage_categories') }}
                            <a class="btn btn-primary pull-right"
                               href="{{ route('admin.categories.create') }}"> {{ trans('admin.create_category') }} </a>
                        </header>
                        <table id="datatable" class="table table-striped table-advance table-hover table-bordered">
                            <thead>
                                <th><i class="fa fa-list-ul"></i> {{ trans('admin.categories') }} </th>
                                <th><i class="fa fa-pencil"></i> {{ trans('admin.description') }} </th>
                                <th id='action_th'><i class="fa fa-cogs"></i> {{ trans('admin.action') }} </th>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td style="text-align: center" class="">
                                        <div class="btn-group">
                                            {!! Form::open(['route' => ['admin.categories.destroy', $category->id], 'action' => 'CategoryController@destroy', 'method' => 'delete']) !!}
                                            <a class="btn btn-primary"
                                               href="{{ route('admin.categories.edit', ['category' => $category]) }}"><i
                                                        class="fa fa-pencil-square-o "></i></a>
                                            <a class="btn btn-success"
                                               href="{{ route('admin.categories.show', ['category' => $category]) }}"><i
                                                        class="fa fa-eye"></i></a>
                                            {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    </section>
                </div>
            </div>
            <!-- page end-->
        </section>
    </section>
@endsection
@section('backend-add-js')
{!! HTML::script('js/frontend/jquery.dataTables.min.js') !!}
{!! HTML::script('js/frontend/dataTables.bootstrap4.min.js') !!}
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
        $('.dataTables_filter').css({'display':'inline','float':'right'});
        $('.dataTables_length').css({'display':'none'});
        $('.dataTables_paginate').css({'display':'none'});
    } );
</script>
@endsection
