<!DOCTYPE html>
<html lang="en">
@section('title')
    {{ __('track.Alpasha Group') }}
@stop
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="alpasha group" />
    <meta name="description" content="مجموعة الباشا الدولية" />
    <meta name="author" content="alpashagroup.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
    @include('layouts.head')
</head>

<body style="font-family: 'Cairo', sans-serif">

<div class="wrapper" style="font-family: 'Cairo', sans-serif">

    <!--=================================
preloader -->

    <div id="pre-loader">
        <img src="{{ URL::asset('assets/images/pre-loader/lo.gif') }}" alt="">
    </div>

    <!--=================================
preloader -->

@include('layouts.main-header')

@include('layouts.main-sidebar')

<!--=================================
 Main content -->
    <!-- main-content -->
    <div class="content-wrapper">
        <div class="page-title" >
            <div class="row">
                <div class="col-sm-6" >
                    <h4 class="mb-0" style="font-family: 'Cairo', sans-serif">{{trans('main_trans.Dashboard_page')}}</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    </ol>
                </div>
            </div>
        </div>
        <!-- widgets -->
        <div class="row" >
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-danger">
                                        <i class="fa fa-bar-chart-o highlight-icon" aria-hidden="true"></i>
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark"> {{ __('track.tracking_count') }}  </p>
                                <h4>{{count($Tracking)}}

                                </h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">


                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-warning">
                                    <i class="fa fa-file-archive-o highlight-icon" aria-hidden="true"></i>

                                    </span>
                            </div>
                           <div class="float-right text-right">
                                <p class="card-text text-dark"> {{ __('track.all_track_archived') }} </p>
                                <h4>{{$Tracking_Archives}}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">

                        </p>
                    </div>
                </div>
            </div>
            
            
            
             <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-primary">
                                        <i class="fa fa-refresh highlight-icon" aria-hidden="true"></i>
                                    </span>
                            </div> 
                            <div class="float-right text-right">
                                <p class="card-text text-dark"> {{ __('track.New_shipments') }} </p>
                                <h4>{{count($track_st)}}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">

                        </p>
                    </div>
                </div>
            </div>
            
            
            
            
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-success">
                                        <i class="fa fa-address-card highlight-icon" aria-hidden="true"></i>
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark"> {{ __('track.customer_count') }}</p>
                                <h4>{{count($clients)}}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">

                        </p>
                    </div>
                </div>
            </div>
           
            
            
            
          
            
            
        </div>


        <!-- widgets -->
        <div class="row" >
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-danger">
                                        <i class="fa fa-cubes highlight-icon" aria-hidden="true"></i>
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark"> {{ __('track.cartons_count') }}</p>
                                <h4>{{$track_cartons_number}}

                                </h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">


                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-warning">
                                    <i class="fa fa-diamond highlight-icon" aria-hidden="true"></i>

                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark"> {{ __('track.pieces_count') }}  </p>
                                <h4>{{$track_pieces_number}}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">

                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-success">
                                        <i class="fa fa-usd highlight-icon" aria-hidden="true"></i>
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">  {{ __('track.total_amount') }} </p>
                                <h4>{{$track_invoice_value}} $</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">

                        </p>
                    </div>
                </div>
            </div>
            
            
              <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-success">
                                        <i class="fa fa-database highlight-icon" aria-hidden="true"></i>
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark"> {{ __('track.all-tracking_count') }} </p>
                                <h4>{{count($Tracking) + $Tracking_Archives}} </h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">

                        </p>
                    </div>
                </div>
            </div>
            

        </div>


        <!-- widgets -->

        <div class="row" >
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-danger">
                                         <img src="{{ URL::asset('assets/images/flags/pl.png') }}" alt="" width=50 height=50 >
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark"> {{ __('track.tarcking_to_Palestine_count') }} </p>
                                <h4>{{$track_st_Palestine}}

                                </h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">


                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-warning">
                                     <img src="{{ URL::asset('assets/images/flags/jo.png') }}" alt="" width=50 height=50 >

                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">{{ __('track.tarcking_to_Jordan_count') }} </p>
                                <h4>{{$track_st_Jordan}}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">

                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-success">
                                        <img src="{{ URL::asset('assets/images/flags/ksa.png') }}" alt="" width=50 height=50 >

                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">  {{ __('track.tarcking_to_Saudi_count') }} </p>
                                <h4>{{$track_Saudi}}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">

                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-primary">

                                        <img src="{{ URL::asset('assets/images/flags/k.png') }}" alt="" width=50 height=50 >
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">{{ __('track.tarcking_to_Kuwait_count') }}</p>
                                <h4>{{$track_Kuwait}}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">

                        </p>
                    </div>
                </div>
            </div>
        </div>


        <!-- widgets -->

        <div class="row" >
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-danger">
                                          <img src="{{ URL::asset('assets/images/flags/em.png') }}" alt="" width=50 height=50 >
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">{{ __('track.tarcking_to_UAE_count') }}</p>
                                <h4>{{$track_Emirates}}

                                </h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">


                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-warning">
                                        <img src="{{ URL::asset('assets/images/flags/ejp.png') }}" alt="" width=50 height=50 >



                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark"> {{ __('track.tarcking_to_Egypt_count') }} </p>
                                <h4>{{$track_Egypt}}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">

                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-success">
                                        <img src="{{ URL::asset('assets/images/flags/kat.png') }}" alt="" width=50 height=50 >
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark"> {{ __('track.tarcking_to_Qatar_count') }}  </p>
                                <h4>{{$track_QATAR}}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">

                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-primary">
                                        <img src="{{ URL::asset('assets/images/flags/san.png') }}" alt="" width=50 height=50 >
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">{{ __('track.tarcking_to_SanMartin_count') }}</p>
                                <h4>{{$track_SANMARTIN}}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">

                        </p>
                    </div>
                </div>
            </div>
            
            
             <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-primary">
                                        <img src="{{ URL::asset('assets/images/flags/oman.png') }}" alt="" width=50 height=50 >
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">  {{ __('track.tarcking_to_Oman_count') }}   </p>
                                <h4>{{$track_OMAN}}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">

                        </p>
                    </div>
                </div>
            </div>
            
             <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-primary">
                                        <img src="{{ URL::asset('assets/images/flags/namibi.png') }}" alt="" width=50 height=50 >
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">{{ __('track.tarcking_to_Namibya_count') }} </p>
                                <h4>{{$track_Namibia}}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">

                        </p>
                    </div>
                </div>
            </div>
            
            
             <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-primary">
                                        <img src="{{ URL::asset('assets/images/flags/usa.png') }}" alt="" width=50 height=50 >
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">{{ __('track.tarcking_to_Usa_count') }}</p>
                                <h4>{{$track_USA}}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">

                        </p>
                    </div>
                </div>
            </div>
            
               <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-primary">
                                        <i class="fa fa-user highlight-icon" aria-hidden="true"></i>
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">{{ __('track.users_count') }}</p>
                                <h4>{{count($users)}}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">

                        </p>
                    </div>
                </div>
            </div>
			
			<!--  -->
			
			
			 <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-primary">
                                        <i class="fa fa-user highlight-icon" aria-hidden="true"></i>
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">Bahrain</p>
                                <h4>{{$track_Bahrain}}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">

                        </p>
                    </div>
                </div>
            </div>
			
			
			
			
			
			 <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-primary">
                                        <i class="fa fa-user highlight-icon" aria-hidden="true"></i>
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">Africa</p>
                                <h4>{{$track_Africa }}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">

                        </p>
                    </div>
                </div>
            </div>
			
			
			
			
			 <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-primary">
                                        <i class="fa fa-user highlight-icon" aria-hidden="true"></i>
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">Indonesia</p>
                                <h4>{{$track_Indonesia}}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">

                        </p>
                    </div>
                </div>
            </div>
			
			
			
			
			
			
			
			 <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-primary">
                                        <i class="fa fa-user highlight-icon" aria-hidden="true"></i>
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">Emirates weight</p>
                                <h4>{{$Emirates_weight}} KG</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">

                        </p>
                    </div>
                </div>
            </div>
			
			
			 <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-primary">
                                        <i class="fa fa-user highlight-icon" aria-hidden="true"></i>
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">All weight</p>
                                <h4>{{$Track_All_weight}} KG</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">

                        </p>
                    </div>
                </div>
            </div>
			
			
			
			<!-- -->
            
            
        </div>



        <!-- Orders Status widgets-->


        <!-- Modal Add Category -->
        <div class="modal" tabindex="-1" role="dialog" id="add-category">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add a category</h5>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body p-20">
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="control-label">Category Name</label>
                                    <input class="form-control form-white" placeholder="Enter name"
                                           type="text" name="category-name" />
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">Choose Category Color</label>
                                    <select class="form-control form-white"
                                            data-placeholder="Choose a color..." name="category-color">
                                        <option value="success">Success</option>
                                        <option value="danger">Danger</option>
                                        <option value="info">Info</option>
                                        <option value="primary">Primary</option>
                                        <option value="warning">Warning</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success save-category"
                                data-dismiss="modal">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!--=================================
wrapper -->

<!--=================================
footer -->

@include('layouts.footer')
</div><!-- main content wrapper end-->
</div>
</div>
</div>

<!--=================================
footer -->

@include('layouts.footer-scripts')

</body>

</html>