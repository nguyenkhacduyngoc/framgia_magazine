@extends('frontend.master')
@section('content')
        <!-- Page Heading -->
        <section class="p-heading text-center">
        	<div class="container">
        		<div class="page-bg">
        			<div class="row">
        				<div class="col-md-12">
        					<div class="p-content">
        						<h4></h4>
        						<ul class="list-unstyled list-inline">
        							<li class="list-inline-item"><a href="#"></a></li>
        							<li class="list-inline-item"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></li>
        						</ul>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </section>
        <!-- End Page Heading -->

        <!-- 404 Error -->
        <section class="error404 text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="err-content">
                            <h1><span></span></h1>
                            <h4>{!! trans('auth.pnf') !!}</h4>
                            <p>{!! trans('auth.wcnf') !!}</p>
                            <a href="{{ route('homepage') }}">{!! trans('auth.home') !!}</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End 404 Error -->
@endsection
