<template>
    <!--header start-->
    <header class="header dark-bg">
        <div class="toggle-nav">
            <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom">
                <i class="fa fa-list"></i>
            </div>
        </div>

        <!--logo start-->
        <a href="" class="logo"> <span class="lite"></span></a>
        <!--logo end-->

        <div class="nav search-row" id="top_menu">
            <!--  search form start -->
            <ul class="nav top-menu">
                <li>
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
                        <span class="username"></span>
                    </a>
                    <ul class="dropdown-menu extended logout">
                        <div class="log-arrow-up"></div>
                        <li class="eborder-top">
                            <a href=""><i class="icon_profile">Home</i></a>
                        </li>
                        <li class="eborder-top">
                            <a href=""><i class="icon_profile">Profile</i></a>
                        </li>
                        <li class="eborder-top">
                            <a class="dropdown-item" href="" onclick="event.preventDefault();document.getElementById('logout-form').submit()">Logout</a>
                            
                        </li>
                    </ul>
                </li>
                <!-- user login dropdown end -->
            </ul>
            <!-- notificatoin dropdown end-->
        </div>
    </header>
    <!--header end--> 
</template>

<script>
    
</script>
