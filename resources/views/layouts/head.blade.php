<!-- Title -->
<title>@yield("title")</title>

<!-- Favicon -->
<link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}" type="image/x-icon"/>

<!-- Font -->
<link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">

@yield('css')
<!--- Style css -->
<link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/extensions/toastr.min.css') }}" rel="stylesheet">
<!--- Style css -->
@if (App::getLocale() == 'ar')
    <link href="{{ URL::asset('assets/css/rtl.css') }}" rel="stylesheet">
@else
    <link href="{{ URL::asset('assets/css/ltr.css') }}" rel="stylesheet">
@endif
<style>
    #toast-container {
        background-image: none;
        background-color: #e9e9e9;
        color: red;
        top: unset;
        bottom: 12px;
    }
    .chart--container {
        height: 100%;
        width: 100%;
        min-height: 530px;
    }

    .zc-ref {
        display: none;
    }
</style>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>
    var notify_count = 0;
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('b955624ddbe90b6a5925', {
        cluster: 'us2'
    });
    @if (auth('web')->check())
        notify_count ={{count(Auth::user()->unreadNotifications)}};
    @endif
            @if (auth('client')->check())
        notify_count ={{count(Auth::guard('client')->user()->unreadNotifications)}};
            @endif
    var channel = pusher.subscribe('albasha-turkey-75');
//    console.log(pusher.id)
    channel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function (data) {
        console.log("data....");
        console.log(data);
        console.log(data.message);
        @if (auth('web')->check())
        if (data.user_id !={{auth('web')->id()}}|| data.n_type != 'user')
            return;
        @endif
                @if (auth('client')->check())
        if (data.user_id !={{auth('client')->id()}}|| data.n_type != 'client')
            return;
        @endif

            notify_count=parseInt(notify_count)+1;
            $('.notify-count').html(notify_count) ;
            toastr['info'](
            data.message,
            {
                closeButton: false,
                tapToDismiss: true,
                positionClass: "toast-bottom-right",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut"
            }
        );
        $(
            ' <a href="{{route('UpdateTracking')}}"' +
            ' class="dropdown-item">'+ data.message+
            '<small class="float-right text-muted time"></small> </a>'
        ).insertAfter('#notify-divi');
    });
    channel.bind('my-notify', function (data) {
        console.log("data....");
        console.log(data);
        console.log(data.message);
        @if (auth('web')->check())
        if (data.user_id !={{auth('web')->id()}}|| data.n_type != 'user')
            return;
        @endif
                @if (auth('client')->check())
        if (data.user_id !={{auth('client')->id()}}|| data.n_type != 'client')
            return;
        @endif

            notify_count=parseInt(notify_count)+1;
            $('.notify-count').html(notify_count) ;
            toastr['info'](
            data.message,
            {
                closeButton: false,
                tapToDismiss: true,
                positionClass: "toast-bottom-right",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
                fadeOut : 6000
            }
        );
        $(
            ' <a href="{{route('UpdateTracking')}}"' +
            ' class="dropdown-item">'+ data.message+
            '<small class="float-right text-muted time"></small> </a>'
        ).insertAfter('#notify-divi');
    });
</script>
