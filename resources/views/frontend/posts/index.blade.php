@extends('frontend.master')
@section('add-css')
{!! Html::style('css/frontend/dataTables.bootstrap4.min.css') !!}
@endsection
@section('content')
    <!-- Page Heading -->
    <section class="p-heading text-center">
        <div class="container">
            <div class="page-bg">
                <div class="row">
                    <div class="col-md-12">
                        <div class="p-content">
                            <h4>{{ trans('auth.my_post') }}</h4>
                            <ul class="list-unstyled list-inline">
                                <li class="list-inline-item"><a
                                            href="{{ route('homepage') }}">{{ trans('auth.homepage') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Page Heading -->

    <!-- News Details -->
    <section class="news-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    @if(Session::has('status'))
                    <div class="alert alert-danger">
                            <ul>
                                <li>{{ Session::get('status') }}</li>
                            </ul>
                        </div>
                    @endif
                    <table id="datatable" class="display table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th><i class="fa fa-pencil"></i> {!! trans('admin.title') !!} </th>
                                <th><i class="fa fa-star"></i> {!! trans('admin.status') !!} </th>
                                <th><i class="fa fa-archive"></i> {!! trans('admin.category') !!} </th>
                                <th><i class="fa fa-user"></i> {!! trans('admin.user') !!} </th>
                                <th><i class="fa fa-clock-o"></i> {!! trans('admin.created_at') !!} </th>
                                <th style="text-align: center"><i class="fa fa-cogs"></i> {!! trans('admin.action') !!}</th>
                            </tr>
                            <tr class="search_table">
                                <th><i class="fa fa-pencil"></i> {!! trans('admin.title') !!} </th>
                                <th><i class="fa fa-star"></i> {!! trans('admin.status') !!} </th>
                                <th><i class="fa fa-archive"></i> {!! trans('admin.category') !!} </th>
                                <th><i class="fa fa-user"></i> {!! trans('admin.user') !!} </th>
                                <th><i class="fa fa-clock-o"></i> {!! trans('admin.created_at') !!} </th>
                                <th style="text-align: center"><i class="fa fa-cogs"></i> {!! trans('admin.action') !!}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td id="table-title"> {!! substr($post->title, 0, 50) !!}{!! strlen($post->title) > 50 ? "...": "" !!} </td>
                                <td>
                                    @if($post->status ==1)
                                        <label for="" class="badge badge-danger"> {!! trans('admin.rejected') !!} </label>
                                    @elseif($post->status==0)
                                        <label for="" class="badge badge-warning"> {!! trans('admin.pending') !!} </label>
                                    @else
                                        <label for="" class="badge badge-success"> {!! trans('admin.accepted') !!} </label>
                                    @endif
                                </td>
                                <td id="table-category">{!! ($post->category ==null) ? null : $post->category->name !!}</td>
                                <td id="table-user">{{ $post->user->fullname }}</td>
                                <td>{{ $post->created_at }}</td>
                                <td style="text-align: center" class="">
                                    <div class="btn-group">
                                        {!! Form::open(['route' => ['posts.destroy', $post->slug], 'action' => 'PostController@destroy', 'method' => 'delete']) !!}
                                        <a class="btn btn-primary"
                                           href="{{ route('posts.edit', ['post' => $post]) }}"><i class="fa fa-pencil-square-o"></i></a>
                                        <a class="btn btn-success"
                                           href="{{ route('posts.show', ['post' => $post]) }}"><i class="fa fa-eye"></i></a>
                                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{-- {{ $posts->links() }} --}}
                </div>
                {{-- @include('frontend.sidebar') --}}
            </div>
        </div>
    </section>
    <!-- End News Details -->
@endsection
@section('add-js')
{!! HTML::script('js/frontend/jquery.dataTables.min.js') !!}
{!! HTML::script('js/frontend/dataTables.bootstrap4.min.js') !!}
<script>
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#datatable thead .search_table th ').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        } );
    
        // DataTable
        var table = $('#datatable').DataTable();
    
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
        
        $('.dataTables_filter').css({'display':'inline','float':'right'});
        
    } );
</script>

@endsection
