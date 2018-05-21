<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
            <li class="">
                <a class="" href="">
                    <i class="fa fa-home"></i>
                    <span> {{ trans('admin.dashboard') }} </span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="javascript:;" class="">
                    <i class="fa fa-user"></i>
                    <span>{{ trans('admin.users') }}</span>
                    <span class="menu-arrow fa fa-arrow-right"></span>
                </a>
                <ul class="sub">
                    <li><a class="fa fa-user-o" href="{{ route('admin.users.index') }}"> {{ trans('admin.manage_user') }} </a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;" class="">
                    <i class="fa fa-list"></i>
                    <span>{{ trans('admin.categories') }}</span>
                    <span class="menu-arrow fa fa-arrow-right"></span>
                </a>
                <ul class="sub">
                    <li><a class="fa fa-indent" href="{{ route('admin.categories.index') }}"> {{ trans('admin.manage_category') }} </a></li>
                    <li><a class="fa fa-plus-square" href="{{ route('admin.categories.create') }}"> {{ trans('admin.create_category') }} </a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;" class="">
                    <i class="fa fa-newspaper-o "></i>
                    <span>{{ trans('admin.posts') }}</span>
                    <span class="menu-arrow fa fa-arrow-right"></span>
                </a>
                <ul class="sub">
                    <li><a class="fa fa-bars " href=""> {{ trans('admin.manage_posts') }} </a></li>
                </ul>
            </li>
            <li class="sub-menu ">
                <a href="javascript:;" class="">
                    <i class="fa fa-file"></i>
                    <span>{{ trans('admin.pages') }}</span>
                    <span class="menu-arrow fa fa-arrow-right"></span>
                </a>
                <ul class="sub">
                    <li><a class="fa fa-user-o" href=""> {{ trans('admin.profile') }} </a></li>
                </ul>
            </li>
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
