<!DOCTYPE html>
<html lang="en">
@section('title')
    {{ __('track.Alpasha Group') }}
@stop
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="ALPASHA GROUP" />
    <meta name="description" content="ALPASHA GROUP " />
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
                    <h4 class="mb-0" style="font-family: 'Cairo', sans-serif">  {{ __('track.dashboard') }} </h4>
                </div>
                <div class="col-sm-6" >
                    <h4 class="mb-0" style="font-family: 'Cairo', sans-serif">  {{ __('track.Your_code_number_is') }} <span class='p-2 badge badge-info'>{{$client_code_number}} </span>   </h4>

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
                                       <img src="{{ URL::asset('assets/images/70.png') }}" alt="" width=50 height=50 >
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark"> {{ __('track.all-tracking_count') }} </p>
                                <h4>
                                    {{ $client_tracking_count }}
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
                                       <img src="{{ URL::asset('assets/images/101.png') }}" alt="" width=50 height=50 >
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">{{ __('track.New_tracking') }} </p>
                                <h4> {{count($track_st)}}</h4>
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
                                         <img src="{{ URL::asset('assets/images/80.png') }}" alt="" width=50 height=50 >
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">{{ __('track.current_balance') }} </p>
                                <h4>{{ $client_account }} $</h4>

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
                                       <img src="{{ URL::asset('assets/images/90.png') }}" alt="" width=50 height=50 >
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">{{ __('track.Paid_balance') }}</p>
                                <h4>{{$client_credit}} $</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">

                        </p>
                    </div>
                </div>
            </div>
        </div>





        <div class="row" >
            <div class="col-xl-4 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-danger">
                                        <i class="fa fa-cubes highlight-icon" aria-hidden="true"></i>
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">{{ __('track.Number_of_cartons') }}  </p>
                                <h4>
                                    {{ $client_cartons_number_count }}
                                </h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">


                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-warning">
                                       <img src="{{ URL::asset('assets/images/60.png') }}" alt="" width=50 height=50 >
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark"> {{ __('track.the_number_pieces') }} </p>
                                <h4> {{$client_pieces_number_count}}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">

                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-success">
                                        <i class="fa fa-bell-o highlight-icon" aria-hidden="true"></i>
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">{{ __('track.Notifications') }}   </p>
                                <h4><span class="badge badge-pill badge-warning notify-count">{{count(Auth::guard('client')->user()->unreadNotifications)}}</span></h4>

                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">

                        </p>
                    </div>
                </div>
            </div>

        </div>

<!---->
<div class="row" >
            <div class="col-xl-4 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100 ">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-info">
                                        <i class="fa fa-plane highlight-icon" aria-hidden="true"></i>
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">{{ __('track.Air_cargo') }}  </p>
                                <h4>
                                    {{ $Air_track }}
                                </h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">


                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-danger">
                                        <i class="fa fa-ship highlight-icon" aria-hidden="true"></i>
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark"> {{ __('track.Sea_cargo') }} </p>
                                <h4 > {{$Sea_track}}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">

                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100 ">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-warning">
                                        <i class="fa fa-truck highlight-icon" aria-hidden="true"></i>
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">{{ __('track.land_cargo') }}   </p>
                                <h4>{{$land_track}}</h4>

                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">

                        </p>
                    </div>
                </div>
            </div>

        </div>
<!---->
        <div class="row" >
    <div class="col-md-6 mb-30" >
        <div class="card card-statistics h-100" style="">
            <div class="card-body">


            <form method="post"

                  @if(auth('client')->check())
                  action="{{ route('client.SearchTrackNumber') }}"
                          @else
                  action="{{ route('SearchTrackNumber') }}"
                  @endif
                  autocomplete="off">
                    @csrf
                    <h6 style="font-family: 'Cairo', sans-serif;text-align: center;
    background-color: #282a39;
    color: #fff;border-radius: 7px;"> {{ __('track.Shipment_Tracking') }} </h6><br>
                    <div class="row">


                    <div class="col-md-12 mg-t-20 mg-lg-t-0" id="tracking_number">
                            <h5 class="mg-b-10" style="font-family: 'Cairo', sans-serif"> {{ __('track.Enter_number_to_details') }} </h5>
                            <input type="text" class="form-control" id="tracking_number" name="tracking_number" style="border: 1px solid #282a39;
    border-radius: 10px;
    margin-bottom: 5px;">



                    </div>

                    </div>
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{ __('track.search') }}</button>
                </form>

        </div>
        </div>
        </div>

        <!---->
        <div class="col-md-6 mb-30" >
        <div class="card card-statistics h-100" style="">
            <div class="card-body">

            <h6 style="font-family: 'Cairo', sans-serif;text-align: center;
    background-color: #282a39;
    color: #fff;border-radius: 7px;">  {{ __('track.Recently_updated_shipments') }} </h6>
           <table  class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead >
                        <tr class="p-3 mb-2 ">
                            <th>#</th>
                            <th>{{ __('track.Tracking Number') }}</th>

                            <th>{{ __('track.Tracking Status') }}</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach($client_trackings_u as $tracks)
                            <tr>
                                <?php $i++; ?>
                                <td class="p-2 m-2">{{ $i }}</td>
                                <td class="p-2 m-2">{{$tracks->tracking_number}}</td>
                               <td class="p-2 m-2">
                                @if($tracks->tacking_status_id == 1)
                                   <span style="padding: 5px;background-color:#00bcd4;color:#fff;"> {{$tracks->status->Status_Name}} </span>
                                @elseif($tracks->tacking_status_id == 2)
                                <span style="padding-right: 5px;padding-left: 5px;background-color:#ffeb3b;color:#fff;"> {{$tracks->status->Status_Name}} </span>
                                @elseif($tracks->tacking_status_id == 3)
                                <span style="padding-right: 5px;padding-left: 5px;background-color:#ffc107;color:#fff;"> {{$tracks->status->Status_Name}} </span>
                                @elseif($tracks->tacking_status_id == 4)
                                <span style="padding-right: 5px;padding-left: 5px;background-color:#ff9800;color:#fff;"> {{$tracks->status->Status_Name}} </span>
                                @elseif($tracks->tacking_status_id == 5)
                                <span style="padding-right: 5px;padding-left: 5px;background-color:#ff5722;color:#fff;"> {{$tracks->status->Status_Name}} </span>
                                @elseif($tracks->tacking_status_id == 6)
                                <span style="padding-right: 5px;padding-left: 5px;background-color:#f44336;color:#fff;"> {{$tracks->status->Status_Name}} </span>
                                @elseif($tracks->tacking_status_id == 7)
                                <span style="padding-right: 5px;padding-left: 5px;background-color:#795548;color:#fff;"> {{$tracks->status->Status_Name}} </span>
                                @elseif($tracks->tacking_status_id == 8)
                                <span style="padding-right: 5px;padding-left: 5px;background-color:#4caf50;color:#fff;"> {{$tracks->status->Status_Name}} </span>
                                @endif
                                </td>


                            </tr>



                            @endforeach

                </table>
           <!---->

        </div>
        </div>
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
