<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="alpasha group" />
    <meta name="description" content="مجموعة الباشا الدولية" />
    <meta name="author" content="alpashagroup.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>مجموعة الباشا الدولية </title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" />

    <!-- Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
        <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

    <!-- css -->
    <link href="{{ URL::asset('assets/css/rtl.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/ltr.css') }}" rel="stylesheet">

</head>

<body style="font-family: 'Cairo', sans-serif">

    <div class="wrapper">

        <!--=================================
 preloader -->

        <div id="pre-loader">
            <img src="images/pre-loader/loader-01.svg" alt="">
        </div>

        <!--=================================
 preloader -->

        <!--=================================
 login-->


      <section class="height-100vh d-flex align-items-center page-section-ptb login"
            style="background-image: url(/../assets/images/login-bg1.jpg); background-repeat: no-repeat;
    background-size: cover;">
            <div class="container">
                <div class="row justify-content-center no-gutters vertical-align">
                    <div class="col-lg-4 col-md-6 login-fancy-bg bg"
                        style="background-image: url(images/login-inner-bg.jpg);">
                        <div class="login-fancy">
                            <h3  style="font-family: 'Cairo', sans-serif;text-align: center" class="text-white mb-20"> {{ __('track.Customer_Login') }}  </h3>
                            <br><br>
                               <img src="/../assets/images/Alogo-alpasha.svg"  alt="">
                               <p style="font-family: 'Cairo', sans-serif;text-align: center;
    font-size: 17px;" class="mb-20 text-white"> 
                              {{ __('track.Alpasha Group') }} </p>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 bg-white">
                        <div class="login-fancy pb-40 clearfix">
                        @if(session('error'))
                              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              <strong>{{session('error')}}</strong>
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                                @endif
                             <div>
                            <h3 class="mb-30" style="font-family: 'Cairo', sans-serif;text-align: center;
    font-size: 17px;color:red;"> {{ __('track.Account_under_review') }} </h3>
    
     <p style="font-family: 'Cairo', sans-serif;text-align: center;
    font-size: 17px;" class="mb-20 text-black"> 
{{ __('track.welcome_to_our_family') }}                            </p>
<p style="font-family: 'Cairo', sans-serif;text-align: center;
    font-size: 14px;" class="mb-20 text-black"> 
{{ __('track.Your_best_choice') }}   </p>
 
                            <a href="{{ route('client_login_from') }}" class="float-right"> <button class="button"><span> {{ __('track.Login') }}</span><i class="fa fa-check"></i></button> </a>
                            <a href="https://alpashagroup.com/" class="float-left"> <button class="button"><span> {{ __('track.Back_to_the_site') }}</span><i class="fa fa-check"></i></button> </a>    
                        </div> 
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--=================================
 login-->

    </div>
    <!-- jquery -->
    <script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <!-- plugins-jquery -->
    <script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>
    <!-- plugin_path -->
    <script>
        var plugin_path = 'js/';

    </script>

    <!-- chart -->
    <script src="{{ URL::asset('assets/js/chart-init.js') }}"></script>
    <!-- calendar -->
    <script src="{{ URL::asset('assets/js/calendar.init.js') }}"></script>
    <!-- charts sparkline -->
    <script src="{{ URL::asset('assets/js/sparkline.init.js') }}"></script>
    <!-- charts morris -->
    <script src="{{ URL::asset('assets/js/morris.init.js') }}"></script>
    <!-- datepicker -->
    <script src="{{ URL::asset('assets/js/datepicker.js') }}"></script>
    <!-- sweetalert2 -->
    <script src="{{ URL::asset('assets/js/sweetalert2.js') }}"></script>
    <!-- toastr -->
    @yield('js')
    <script src="{{ URL::asset('assets/js/toastr.js') }}"></script>
    <!-- validation -->
    <script src="{{ URL::asset('assets/js/validation.js') }}"></script>
    <!-- lobilist -->
    <script src="{{ URL::asset('assets/js/lobilist.js') }}"></script>
    <!-- custom -->
    <script src="{{ URL::asset('assets/js/custom.js') }}"></script>

</body>

</html>
