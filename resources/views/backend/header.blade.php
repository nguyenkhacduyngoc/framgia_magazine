<!--header start-->
<header class="header dark-bg">
    <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom">
            <iclass="fa fa-list"></i>
        </div>
    </div>

    <!--logo start-->
    <a href="" class="logo">{{ trans('admin.nice') }} <span class="lite">{!! trans('admin.admin') !!}</span></a>
    <!--logo end-->

    <div class="nav search-row" id="top_menu">
        <!--  search form start -->
        <ul class="nav top-menu">
            <li>
                {!! Form::open(['route' => 'logout','method' => 'post','class' => 'navbar-form']) !!}
                {!! Form::input('text', '', null, ['placeholder' => trans('auth.search_here'), 'class' => 'form-control']) !!}
                {!! Form::close() !!}
            </li>
        </ul>
        <!--  search form end -->
    </div>

    <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">
            <!-- user login dropdown start-->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <span class="profile-ava">
                    <img alt="" src="">
                </span>
                    <span class="username">{{ trans('admin.admin') }}</span>
                </a>
                <ul class="dropdown-menu extended logout">
                    <div class="log-arrow-up"></div>
                    <li class="eborder-top">
                        <a href="#"><i class="icon_profile"></i>{{ trans('admin.profile') }}</a>
                    </li>
                    <li class="eborder-top">
                        <a href="{{ route('logout') }}"><i class="icon_key_alt"></i>{{ trans('auth.logout') }}</a>
                    </li>
                </ul>
            </li>
            <!-- user login dropdown end -->
        </ul>
        <!-- notificatoin dropdown end-->
    </div>
</header>
<!--header end-->
