<template>
    <div>
        <aside>
            <div id="sidebar" class="nav-collapse ">
                <!-- sidebar menu start-->
                <ul class="sidebar-menu">
                    <li class="">
                        <router-link :to="{ name:'dashboard' }">
                            <i class="fa fa-home"></i>
                            <span> Dash Board </span>
                        </router-link>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;" class="">
                            <i class="fa fa-user"></i>
                            <span>Users</span>
                            <span class="menu-arrow fa fa-arrow-right"></span>
                        </a>
                        <ul class="sub">
                            <li><a class="fa fa-user-o" href=""> Manage Users </a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;" class="">
                            <i class="fa fa-list"></i>
                            <span>Categories</span>
                            <span class="menu-arrow fa fa-arrow-right"></span>
                        </a>
                        <ul class="sub">
                            <li><router-link class="fa fa-indent" :to="{ name:'categories' }">Category</router-link></li>
                            <li><router-link class="fa fa-plus-square" :to="{ name:'create-category' }">Create Category</router-link></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;" class="">
                            <i class="fa fa-newspaper-o "></i>
                            <span>Post</span>
                            <span class="menu-arrow fa fa-arrow-right"></span>
                        </a>
                        <ul class="sub">
                            <li><a class="fa fa-bars " href=""> Manage Post </a></li>
                        </ul>
                    </li>
                    <li class="sub-menu ">
                        <a href="javascript:;" class="">
                            <i class="fa fa-file"></i>
                            <span>Pages</span>
                            <span class="menu-arrow fa fa-arrow-right"></span>
                        </a>
                        <ul class="sub">
                            <li><a class="fa fa-user-o" href=""> Profile </a></li>
                        </ul>
                    </li>
                </ul>
                <!-- sidebar menu end-->
            </div>
        </aside>
    </div>
</template>

<script>
    
</script>
