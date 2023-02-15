<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">

            @if (auth('web')->check())
                @include('layouts.main-sidebar.admin-main-sidebar')
            @endif

            @if (auth('client')->check())
                @include('layouts.main-sidebar.client-main-sidebar')
            @endif



        </div>


        <!-- Left Sidebar End-->

        <!--=================================
