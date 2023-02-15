
        <!--=================================
 header start-->
 <nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <!-- logo -->
            <div class="text-left navbar-brand-wrapper">
                <a class="navbar-brand brand-logo" href=""><img src="{{url('upload/logo-yeni.png')}}" style="width: 188px;
    height: 59px;" alt=""></a>
                <a class="navbar-brand brand-logo-mini" href=""><img src="{{url('upload/logo-yeni.png')}}"
                        alt=""></a>
            </div>
            <!-- Top bar left -->
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item">
                    <a id="button-toggle" class="button-toggle-nav inline-block ml-20 pull-left"
                        href="javascript:void(0);"><i class="zmdi zmdi-menu ti-align-right"></i></a>
                </li>
                <li class="nav-item">
                    <div class="search">
                        <a class="search-btn not_click" href="javascript:void(0);"></a>
                        <div class="search-box not-click">
                            <input type="text" class="not-click form-control" placeholder="Search" value=""
                                name="search">
                            <button class="search-button" type="submit"> <i class="fa fa-search not-click"></i></button>
                        </div>
                    </div>
                </li>
            </ul>
            <!-- top bar right -->


            @if (auth('web')->check())
                @include('layouts.main-header.admin-main-header')
            @endif

            @if (auth('client')->check())
                @include('layouts.main-header.client-main-header')
            @endif



            </nav>
        <!--=================================
 header End-->


