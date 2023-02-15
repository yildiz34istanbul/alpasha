@extends('layouts.master')
@section('css')


<style>
        @media print {
            #print_Button {
                display: none;
            }
        }


        body{color: #000;overflow-x: hidden;height: 100%;background-color: #2ecc71;background-repeat: no-repeat}.card{z-index: 0;background-color: #ECEFF1;padding-bottom: 20px;margin-top: 90px;margin-bottom: 90px;border-radius: 10px}.top{padding-top: 40px;padding-left: 13% !important;padding-right: 13% !important}#progressbar{margin-bottom: 30px;overflow: hidden;color: #455A64;padding-left: 0px;margin-top: 30px}#progressbar li{list-style-type: none;font-size: 13px;width: 20%;float: left;position: relative;font-weight: 400}#progressbar .step0:before{font-family: FontAwesome;content: "\f10c";color: #fff}#progressbar li:before{width: 40px;height: 40px;line-height: 45px;display: block;font-size: 20px;background: #C5CAE9;border-radius: 50%;margin: auto;padding: 0px}#progressbar li:after{content: '';width: 100%;height: 12px;background: #C5CAE9;position: absolute;left: 0;top: 16px;z-index: -1}#progressbar li:last-child:after{border-top-right-radius: 10px;border-bottom-right-radius: 10px;position: absolute;left: -50%}#progressbar li:nth-child(2):after, #progressbar li:nth-child(3):after , #progressbar li:nth-child(4):after{left: -50%}#progressbar li:first-child:after{border-top-left-radius: 10px;border-bottom-left-radius: 10px;position: absolute;left: 50%}#progressbar li:last-child:after{border-top-right-radius: 10px;border-bottom-right-radius: 10px}#progressbar li:first-child:after{border-top-left-radius: 10px;border-bottom-left-radius: 10px}#progressbar li.active:before, #progressbar li.active:after{background: #651FFF}#progressbar li.active:before{font-family: FontAwesome;content: "\f00c"}.icon{width: 60px;height: 60px;margin-right: 15px}.icon-content{padding-bottom: 20px}@media screen and (max-width: 992px){.icon-content{width: 50%}}





    </style>
@section('title')
{{ __('track.Reports') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('track.Reports') }}</h4>
        </div>
        <div class="col-sm-6">

        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">


            <form method="post"  action="{{ route('Search.order') }}" autocomplete="off">
                    @csrf
                    <h6 style="font-family: 'Cairo', sans-serif;">{{ __('track.Search information') }}</h6><br>
                    <div class="row">


                    <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="tracking_number">
                            <p class="mg-b-10">{{ __('track.Search by tracking number') }} </p>
                            <input type="text" class="form-control" id="tracking_number" name="tracking_number"  onchange="console.log($(this).val())">



                    </div>
                    </div>
                    <button id="but_fetchall"  class="btn  search btn-success btn-sm nextBtn btn-lg pull-right" type="submit" data-toggle="modal" data-target="#myModal">{{ __('track.search') }}</button>
                </form>

        </div>









        @if (isset($details))

        <div class="card-body">


        <div class="card">
        <div class="row d-flex justify-content-between px-3 top">
            <div class="d-flex">

                <h5>ORDER <span class="text-primary font-weight-bold">{{ $teack_id['tacking_status_id'] ? $teack_id['tacking_status_id'] : '' }}</span></h5>

            </div>
            <div class="d-flex flex-column text-sm-right">
                <p class="mb-0">Expected Arrival <span>01/06/20</span></p>
                <p>Grasshoppers <span class="font-weight-bold"><a href="https://www.grasshoppers.lk/customers/action/track/V534HB">V534HB</a></span></p>
            </div>
        </div> <!-- Add class 'active' to progress -->
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <ul id="progressbar" class="text-center">
                    <li  id="step1" class="active step0"></li>
                    <li id="step2"   class="step0  "></li>
                    <li id="step3" class="step0  "></li>
                    <li  id="step4" class="step0  "></li>
                    <li class="step0"></li>
                </ul>
            </div>
        </div>
        <div class="row justify-content-between top">
            <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/9nnc9Et.png">
                <div class="d-flex flex-column">
                    <p class="font-weight-bold">Order<br>Processed</p>
                </div>
            </div>
            <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/GiWFtVu.png">
                <div class="d-flex flex-column">
                    <p class="font-weight-bold">Order<br>Designing</p>
                </div>
            </div>
            <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/u1AzR7w.png">
                <div class="d-flex flex-column">
                    <p class="font-weight-bold">Order<br>Shipped</p>
                </div>
            </div>
            <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/TkPm63y.png">
                <div class="d-flex flex-column">
                    <p class="font-weight-bold">Order<br>En Route</p>
                </div>
            </div>
            <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/HdsziHP.png">
                <div class="d-flex flex-column">
                    <p class="font-weight-bold">Order<br>Arrived</p>
                </div>
            </div>
        </div>
    </div>









            <div class="table-responsive">

                <div class=" main-content-body-invoice" id="print">




                    <table id="example" class="table key-buttons text-md-nowrap" style=" text-align: center">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>{{ __('track.Tracking Number') }}</th>
                            <th>{{ __('track.Code Number') }}</th>
                            <th>{{ __('track.Tracking Status') }}</th>
                            <th>{{ __('track.country') }}</th>
                            <th>{{ __('track.type tracking') }}</th>
                            <th>{{ __('track.User') }}</th>

                             <th>{{ __('track.updated at') }}</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($details as $track)
                                <?php $i++; ?>
                                <tr>
                                <td>{{ $i }}</td>
                                <td>{{$track->tracking_number}}</td>
                                <td>{{$track->code_number}}</td>
                                <td>{{$track->status->Status_Name}}</td>
                                <td>{{$track->Country ?  $track->Country->Country_Name : ''}}</td>

                                <td>{{$track->tracktype ? $track->tracktype->tracking_type_name : ''}}</td>

                                <td>{{$track->user}}</td>

                                <td>
                                @if($track->updated_at == NULL)
                  <span class="text-danger"> No Date</span>
                   @else
                  {{Carbon\Carbon::parse($track->updated_at)->toDateString()}}

                  @endif
                                </td>
                                </tr>


                            @endforeach
                        </tbody>
                    </table>
                    <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
                                class="mdi mdi-printer ml-1"></i>{{ __('track.Print') }}</button>
                                </div>













                    @endisset

            </div>















            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

<script>
    var date = $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    }).val();
</script>


<script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>


<script>
                $(document).ready(function ()
                 {
                    $('#but_fetchall').click(function(){




            $.ajax({
                                url: "/search",
                                type: "GET",
                                dataType: "json",
                                success: function (response) {
                                    console.log(response);

                                }
                            });



           }





                 }




















            </script>



@endsection
