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
            <i class="ti-bell"><span class="badge badge-pill badge-warning notify-count">{{count(Auth::guard('client')->user()->unreadNotifications)}}</span></i>
            <span class="badge badge-danger notification-status"> </span>
        </a>

        <div id="notify-menu" class="dropdown-menu dropdown-menu-right dropdown-big dropdown-notifications">
            <div class="dropdown-header notifications">
                <strong>{{ __('track.Notifications') }}</strong>
                <span class="badge badge-pill badge-warning notify-count">{{count(Auth::guard('client')->user()->unreadNotifications)}}</span>
            </div>
            <div class="dropdown-divider"  id="notify-divi"></div>
            @foreach(Auth::guard('client')->user()->unreadNotifications()->paginate(15) as $noty)
                <a href="{{route('Track.show').'?not_id='.$noty->id}}" class="dropdown-item">{!! $noty->data['data'] !!}  <small
                            class="float-right text-muted time"></small> </a>

            @endforeach
            @if(count(Auth::guard('client')->user()->unreadNotifications)!=0)
                   <div class="d-flex justify-content-between align-items-center " >
                   <div class="btn-group">
                   <a href="{{route('ClientMarkAsRead_all')}}" class="dropdown-item">
                   <span class="badge badge-danger">{{ __('track.read') }}</span>
                   <small class="float-right text-muted time"></small> </a>
                                <a href="{{route('Client.notification.all')}}" class="dropdown-item">
                                <h4 class="badge badge-dark font-weight-bold" >{{ __('track.all_Notifications') }}</h4>
                                   </a>
                    </div>
                    </div>
            @endif
        </div>



    </li>

    <li class="nav-item dropdown mr-30">
        <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button"
           aria-haspopup="true" aria-expanded="false">
            <img src="{{ (!empty(Auth::guard('client')->user()->profile_photo_path))? url('upload/client_images/'.Auth::guard('client')->user()->profile_photo_path):url('upload/no-image.png') }}"  alt="avatar">


        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-header">
                <div class="media">
                    <div class="media-body">

                        <h5 class="mt-0 mb-0">{{ Auth::guard('client')->user() ? Auth::guard('client')->user()->name : '' }}</h5>
                        <span>{{  Auth::guard('client')->user() ?Auth::guard('client')->user()->email : '' }}</span>
                    </div>
                </div>
            </div>
            <div class="dropdown-divider"></div>

            <a class="dropdown-item" href="{{ route('ClientProfile.View') }}"><i class="text-warning ti-user"></i>{{ __('track.Profile') }}</a>
            <a class="dropdown-item" href="{{ route('Clientpassword.view') }}"><i class="text-warning ti-marker-alt"></i>{{ __('track.change_password') }}</a>
            <a class="dropdown-item" href="{{ route('Delete.Account') }}"><i class="text-danger ti-close"></i>{{ __('track.delete_account') }}</a>
            <div class="dropdown-divider"></div>
        <!--  <a href="{{ route('client.logout') }}"><span><i class="fas fa-unlock-alt"></i></span> Logout</a></li> -->
            <a class="dropdown-item" href="{{ route('client.logout') }}" ><i class="text-danger ti-unlock"></i>{{ __('track.logout') }}</a>


    </li>
</ul>
