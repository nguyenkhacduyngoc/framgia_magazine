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
                                <tr>
                                    <th><i class="fa fa-list-ul"></i> {{ trans('admin.categories') }} </th>
                                    <th><i class="fa fa-pencil"></i> {{ trans('admin.description') }} </th>
                                    <th id='action_th'><i class="fa fa-cogs"></i> {{ trans('admin.action') }} </th>
                                </tr>
                                <tr class="search_table">
                                    <th><i class="fa fa-list-ul"></i> {{ trans('admin.categories') }} </th>
                                    <th><i class="fa fa-pencil"></i> {{ trans('admin.description') }} </th>
                                    <th id='action_th'><i class="fa fa-cogs"></i> {{ trans('admin.action') }} </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td style="text-align: center" class="">
                                        <div class="btn-group">
                                            {!! Form::open(['route' => ['admin.categories.destroy', $category->id], 'action' => 'CategoryController@destroy', 'method' => 'delete', 'onsubmit' => 'return ConfirmDelete()']) !!}
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
                        {{-- {{ $categories->links() }} --}}
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
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#datatable thead .search_table th ').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        } );
    
        // DataTable
        var table = $('#datatable').DataTable();
        $('.dataTables_filter').css({'display':'inline','float':'right'});
        // Apply the search
        table.columns().every( function () {
            var that = this;
    
            $( 'input', this.header() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );
    } );
</script>
{!! Html::script('js/frontend/test.js') !!}
@endsection
