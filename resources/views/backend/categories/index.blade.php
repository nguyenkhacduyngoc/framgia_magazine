@extends('backend.master')
@section('backend-content')
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-table"></i> {{ trans('admin.categories') }} </h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="index.html"> {{ trans('admin.admin') }} </a></li>
                        <li><i class="fa fa-table"></i> {{ trans('admin.categories') }} </li>
                        <li><i class="fa fa-th-list"></i> {{ trans('admin.manage_categories') }} </li>
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
                               href="{{ route('categories.create') }}"> {{ trans('admin.create_category') }} </a>
                        </header>
                        <table class="table table-striped table-advance table-hover">
                            <tbody>
                            <tr>
                                <th><i class="fa fa-list-ul"></i> {{ trans('admin.categories') }} </th>
                                <th><i class="fa fa-pencil"></i> {{ trans('admin.description') }} </th>
                                <th id='action_th'><i class="fa fa-cogs"></i> {{ trans('admin.action') }} </th>
                            </tr>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td style="text-align: center" class="">
                                        <div class="btn-group">
                                            {!! Form::open(['route' => ['categories.destroy',$category->id],'action' => 'CategoryController@destroy','method' => 'delete']) !!}
                                            <a class="btn btn-primary"
                                               href="{{ route('categories.edit',['category' => $category]) }}"><i
                                                        class="fa fa-pencil-square-o "></i></a>
                                            <a class="btn btn-success"
                                               href="{{ route('categories.show',['category' => $category]) }}"><i
                                                        class="fa fa-eye"></i></a>
                                            {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit','class' => 'btn btn-danger']) !!}
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
