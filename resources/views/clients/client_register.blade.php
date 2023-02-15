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
    <!-- css -->
    <link href="{{ URL::asset('assets/css/rtl.css') }}" rel="stylesheet">
	<style>
	select.form-control:not([size]):not([multiple]) {
    height: calc(2.8rem + 7px);
}
	
	</style>
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
            style="background-image: url(/../assets/images/re.jpg); background-repeat: no-repeat;
    background-size: cover;">
            <div class="container">
                <div class="row justify-content-center no-gutters vertical-align">
                    <div class="col-lg-3 col-md-6 login-fancy-bg bg"
                        style="background-image: url(images/login-inner-bg.jpg);">
                        <div class="login-fancy">
                            <h3  style="font-family: 'Cairo', sans-serif;text-align: center" class="text-white mb-20">  {{ __('track.Customer_registration') }}   </h3>
                            <br><br>
                               <img src="/../assets/images/Alogo-alpasha.svg"  alt="">
                               <p style="font-family: 'Cairo', sans-serif;text-align: center;
    font-size: 17px;" class="mb-20 text-white">   {{ __('track.Alpasha Group') }}
								   
                               </p>
						
	 <a style="font-family: 'Cairo', sans-serif;text-align: center" href="https://alpashagroup.com/" class="float-left"> <button class="button"><span> {{ __('track.Back_to_the_site') }}</span><i class="fa fa-check"></i></button> </a>

                </div>
                        </div>
						
                    
					
                    <div class="col-lg-9 col-md-6 bg-white">
                        <div class="login-fancy pb-40 clearfix">
                  <!--      @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif -->
                        @if(session('error'))
                              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              <strong>{{session('error')}}</strong>
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                                @endif
                            <h3 class="mb-30">  {{ __('track.Customer_registration') }}</h3>




                            <form action="{{ route('client.register.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="name" class="mr-sm-2">{{ __('track.user_name') }}
                                </label>
                            <input id="name" type="text" name="name" class="form-control" required>
                            @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col">
                            <label for="password" class="mr-sm-2">{{ __('track.password') }}
                                </label>
                            <input type="password" class="form-control" name="password" required>
                            @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>

                    </div>
                    <div class="row">
                    <div class="col">
                            <label for="email" class="mr-sm-2">{{ __('track.email') }}
                                </label>
                                <input type="email" class="form-control" name="email" required>
                                @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        </div>
                        <div class="col">

                        <label for="code_number" class="mr-sm-2">{{ __('track.Code Number_client') }}
                                </label>
                                <input type="number" class="form-control" name="code_number" required>
                                @error('code_number')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                        </div>

                        <div class="row">
                        <div class="col">
                            <label for="phone" class="mr-sm-2">{{ __('track.Mobile_number') }}
                                </label>
                                <input type="number" class="form-control" name="phone" required>
							 <small>Format: 00901234567890</small><br><br>
                                @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col">
                            <label for="locale" class="mr-sm-2">{{ __('track.notification_language') }}
                                </label>
                                <select class="form-control"  name="locale" aria-label="Default select example" required>
                                

                                <option value="ar">Ar</option>
                                <option value="tr">Tr</option>
                                <option value="en">En</option>

</select>
@error('locale')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        </div>

                    </div>


                    <div class="row">
                        <div class="col">
                            <label for="country" class="mr-sm-2">{{ __('track.country') }}
                                </label>
                                <input type="text" class="form-control" name="country" required>
                                @error('country')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col">
                            <label for="address" class="mr-sm-2">{{ __('track.address') }}
                                </label>
                                <input type="text" class="form-control" name="address" required>

                                @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                        </div>
                        <div class="col">
                            <label for="address" class="mr-sm-2">{{ __('track.City') }}
                                </label>
                                <input type="text" class="form-control" name="city" required>

                                @error('city')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                        </div>


                    </div>
                    <div class="row">
                        <div class="col"><br>
                        <div class="form-group">
                        <label for="academic_year">  {{ __('track.ID_photo') }} </label><br>

                            <div class="controls">
	             <input type="file"  accept="image/*" name="id_photo" class="form-control" id="id_photo"  >  </div>
                        </div>
                        </div>
                        @error('id_photo')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>


                    <div class="form-group">

                    </div>
                    <br><br>
            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-success">{{ __('track.registration') }} </button>
            </div>
            </form>

	










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
