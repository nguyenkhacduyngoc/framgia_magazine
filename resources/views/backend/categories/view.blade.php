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
                        <li><i class="fa fa-th-list"></i> {{ trans('admin.view_category') }} </li>
                    </ol>
                </div>
            </div>
            <!-- page start-->
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                            {{ trans('admin.view_category') }}
                        </header>
                        <table class="table">
                            <thead>
                            <tr>
                                <th> {{ trans('admin.name') }} </th>
                                <td> {{ $category->name }} </td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th> {{ trans('admin.description') }} </th>
                                <td> {{ $category->description }} </td>
                            </tr>
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
            <!-- page end-->
        </section>
    </section>
@endsection
