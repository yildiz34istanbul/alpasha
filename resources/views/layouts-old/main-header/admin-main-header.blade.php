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
       <!--  <li class="nav-item">
            <div class="search">
                <a class="search-btn not_click" href="javascript:void(0);"></a>
                <div class="search-box not-click">
                   <input type="text" class="not-click form-control" placeholder="Search" value=""
                           name="search"> 
                    <button class="search-button" type="submit"> <i class="fa fa-search not-click"></i></button>
                </div>
            </div>
        </li> -->
    </ul>
    <!-- top bar right -->
    <ul class="nav navbar-nav ml-auto">


        <div class="btn-group mb-1">
            <button type="button" class="btn btn-light btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if (App::getLocale() == 'ar')
                    {{ LaravelLocalization::getCurrentLocaleName() }}
                    <img src="{{ URL::asset('assets/images/flags/SA.png') }}" alt="">
                @elseif (App::getLocale() == 'tr')
                    {{ LaravelLocalization::getCurrentLocaleName() }}
                    <img src="{{ URL::asset('assets/images/flags/TR.png') }}" alt="">
                @else
                    {{ LaravelLocalization::getCurrentLocaleName() }}
                    <img src="{{ URL::asset('assets/images/flags/GB.png') }}" alt="">

                @endif
            </button>
            <div class="dropdown-menu">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                    </a>
                @endforeach
            </div>
        </div>




        <li class="nav-item fullscreen">
            <a id="btnFullscreen" href="#" class="nav-link"><i class="ti-fullscreen"></i></a>
        </li>
        <li class="nav-item dropdown ">
            <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
               aria-expanded="false">
                <i class="ti-bell"><span class="badge badge-pill badge-warning notify-count" >{{count(Auth::user()->unreadNotifications)}}</span></i>
                <span class="badge badge-danger notification-status"> </span>
            </a>

            <div id="notify-menu" class="dropdown-menu dropdown-menu-right dropdown-big dropdown-notifications">
                <div class="dropdown-header notifications">
                    <strong>{{ __('track.Notifications') }}</strong>
                    <span class="badge badge-pill badge-warning notify-count">{{count(Auth::user()->unreadNotifications)}}</span>
                </div>
                <div class="dropdown-divider" id="notify-divi"></div>
                @foreach(Auth::user()->unreadNotifications()->paginate(15) as $noty)
                    <a c href="{{route('UpdateTracking').'?not_id='.$noty->id}}" class="dropdown-item">{!! $noty->data['data'] !!}  <small
                                class="float-right text-muted time notify-1"></small> </a>

                @endforeach
                @if(count(Auth::user()->unreadNotifications)!=0)
                     <div class="d-flex justify-content-between align-items-center">
                   <div class="btn-group">
                   <a href="{{route('MarkAsRead_all')}}" class="dropdown-item"> <span class="badge badge-danger">{{ __('track.read') }}</span> <small
                                class="float-right text-muted time"></small> </a>
                                <a href="{{route('notification.all')}}" class="dropdown-item"> <h4 class="badge badge-dark font-weight-bold" >{{ __('track.all_Notifications') }}</h4> <small
                                class="float-right text-muted time"></small> </a>
                    </div>
                    </div>

                @endif
            </div>


        </li>

        <li class="nav-item dropdown mr-30">
            <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button"
               aria-haspopup="true" aria-expanded="false">
                <img src="{{ (!empty(Auth::user()->profile_photo_path))? url('upload/user_images/'.Auth::user()->profile_photo_path):url('upload/no-image.png') }}"  alt="avatar">


            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header">
                    <div class="media">
                        <div class="media-body">

                            <h5 class="mt-0 mb-0">{{ Auth::user() ? Auth::user()->name : '' }}</h5>
                            <span>{{  Auth::user() ?Auth::user()->email : '' }}</span>
                        </div>
                    </div>
                </div>
                <div class="dropdown-divider"></div>


                <a class="dropdown-item" href="{{ route('ProfileView') }}"><i class="text-warning ti-user"></i>{{ __('track.Profile') }}</a>
                <a class="dropdown-item" href="{{ route('password.view') }}"><i class="text-warning ti-marker-alt"></i>{{ __('track.change_password') }}</a>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="text-danger ti-unlock"></i>{{ __('track.logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
<!--=================================
header End-->