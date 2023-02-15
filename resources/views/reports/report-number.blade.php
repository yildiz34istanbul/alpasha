@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
<style>
        @media print {
            #print_Button {
                display: none;
            }
        }
    </style>
    
    
    
     @if (App::getLocale() == 'ar')

        <style>

            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            @font-face {
                font-family: pop;
                src: url(./Fonts/Poppins-Medium.ttf);
            }

            .main{
                width: 100%;
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                font-family: pop;
                flex-direction: column;

            }
            .head{
                text-align: center;
            }
            .head_1{
                font-size: 30px;
                font-weight: 600;
                color: #333;
            }
            .head_1 span{
                color: #ff4732;
            }
            .head_2{
                font-size: 16px;
                font-weight: 600;
                color: #333;
                margin-top: 3px;
            }
            ul{
                display: flex;
                margin-top: 80px;

            }
            .ul-track{
                display: flex;
                margin-top: 80px;
                background-color: #160e33;
                padding: 37px;
                z-index: 1;
                border-radius: 20px;
            }

            ul li{
                list-style: none;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            ul li .icon{
                font-size: 35px;
                color: #fff;
                margin: 0 60px;
            }
            ul li .text{
                font-size: 14px;
                font-weight: 600;
                color: #fff;

            }

            /* Progress Div Css  */

            ul li .progress0{
                width: 30px;
                height: 30px;
                border-radius: 50%;
                background-color: rgba(68, 68, 68, 0.781);
                margin: 14px 0;
                display: grid;
                place-items: center;
                color: #fff;
                position: relative;
                cursor: pointer;
            }
            .progress0::after{
                content: " ";
                position: absolute;
                width: 135px;
                height: 5px;
                background-color: rgba(68, 68, 68, 0.781);
                left: 30px;
                z-index: 1;
            }

            .one::after{
                width: 0;
                height: 0;
            }
            ul li .progress0 .uil{
                display: none;
            }
            ul li .progress0 p{
                font-size: 13px;
            }

            /* Active Css  */

            ul li .active{
                background-color: #2ab526;
                display: grid;
                place-items: center;
                z-index: 2;
            }
            li .active::after{
                background-color: #2ab526;
            }
            ul li .active p{
                display: none;
            }
            ul li .active .uil{
                font-size: 20px;
                display: flex;
            }

            /* Responsive Css  */

            @media (max-width: 980px) {
                ul{
                    flex-direction: column;
                }
                ul li{
                    flex-direction: row;
                }
                ul li .progress0{
                    margin: 0 30px;
                }
                .progress0::after{
                    width: 5px;
                    height: 55px;
                    bottom: 30px;
                    left: 50%;
                    transform: translateX(-50%);
                    z-index: -1;
                }
                .one::after{
                    height: 0;
                }
                ul li .icon{
                    margin: 15px 0;
                }

            }

            @media (max-width:600px) {
                .head .head_1{
                    font-size: 24px;
                }
                .head .head_2{
                    font-size: 16px;
                }

            }



        </style>
    @else


        <style>

            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            @font-face {
                font-family: pop;
                src: url(./Fonts/Poppins-Medium.ttf);
            }

            .main{
                width: 100%;
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                font-family: pop;
                flex-direction: column;

            }
            .head{
                text-align: center;
            }
            .head_1{
                font-size: 30px;
                font-weight: 600;
                color: #333;
            }
            .head_1 span{
                color: #ff4732;
            }
            .head_2{
                font-size: 16px;
                font-weight: 600;
                color: #333;
                margin-top: 3px;
            }
            ul{
                display: flex;
                margin-top: 80px;

            }
            .ul-track{
                display: flex;
                margin-top: 80px;
                background-color: #160e33;
                padding: 37px;
                z-index: 1;
                border-radius: 20px;
            }

            ul li{
                list-style: none;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            ul li .icon{
                font-size: 35px;
                color: #fff;
                margin: 0 60px;
            }
            ul li .text{
                font-size: 14px;
                font-weight: 600;
                color: #fff;

            }

            /* Progress Div Css  */

            ul li .progress0{
                width: 30px;
                height: 30px;
                border-radius: 50%;
                background-color: rgba(68, 68, 68, 0.781);
                margin: 14px 0;
                display: grid;
                place-items: center;
                color: #fff;
                position: relative;
                cursor: pointer;
            }
            .progress0::after{
                content: " ";
                position: absolute;
                width: 135px;
                height: 5px;
                background-color: rgba(68, 68, 68, 0.781);
                right: 28px;
                z-index: 0;
            }

            .one::after{
                width: 0;
                height: 0;
            }
            ul li .progress0 .uil{
                display: none;
            }
            ul li .progress0 p{
                font-size: 13px;
            }

            /* Active Css  */

            ul li .active{
                background-color: #2ab526;
                display: grid;
                place-items: center;
                z-index: 5;
            }
            li .active::after{
                background-color: #2ab526;
            }
            ul li .active p{
                display: none;
            }
            ul li .active .uil{
                font-size: 20px;
                display: flex;
            }

            /* Responsive Css  */

            @media (max-width: 980px) {
                ul{
                    flex-direction: column;
                }
                ul li{
                    flex-direction: row;
                }
                ul li .progress0{
                    margin: 0 30px;
                }
                .progress0::after{
                    width: 5px;
                    height: 55px;
                    bottom: 30px;
                    left: 50%;
                    transform: translateX(-50%);
                    z-index: 1;
                }
                .one::after{
                    height: 0;
                }
                ul li .icon{
                    margin: 15px 0;
                }
            }

            @media (max-width:600px) {
                .head .head_1{
                    font-size: 24px;
                }
                .head .head_2{
                    font-size: 16px;
                }
            }



        </style>
        
            @endif

    
    
    
    
@section('title')
{{ __('track.Shipment_Tracking') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> </h4>
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


            <form method="post"

                  @if(auth('client')->check())
                  action="{{ route('client.SearchTrackNumber') }}"
                          @else
                  action="{{ route('SearchTrackNumber') }}"
                  @endif
                  autocomplete="off">
                    @csrf
                    <h6 style="font-family: 'Cairo', sans-serif;">{{ __('track.Shipment_Tracking') }}</h6><br>
                    <div class="row">


                    <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="tracking_number">
                            <p class="mg-b-10" style="font-family: 'Cairo', sans-serif;">{{ __('track.Search by tracking number') }} </p>
                            <input type="text" class="form-control" id="tracking_number" name="tracking_number">



                    </div>
                    </div>
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{ __('track.search') }}</button>
                </form>

        </div>
        <div class="card-body">
            <div class="table-responsive" >
                @if (isset($details))

                <div class=" main-content-body-invoice"  id="print">


@php
$stage=0;
@endphp





   

                                <div class="main">

                                    <ul class="ul-track">
                                        <li>
                                           
 <i class="icon uil uil-shopping-cart-alt"></i>
                                            <div id="stage1" class="progress0 one ">
                                                <p>1</p>
                                                 

                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text" style="font-family: 'Cairo', sans-serif;"> {{(\App\Models\Track_status::find(1)->Status_Name )}}
                                            </p>
                                        </li>
                                        <li>
                                            <i class="icon uil uil-file-check-alt"></i>
                                            <div id="stage2" class="progress0 two ">
                                                <p>2</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text" style="font-family: 'Cairo', sans-serif;" > {{(\App\Models\Track_status::find(2)->Status_Name )}}</p>
                                        </li>
                                        <li>
                                            <i class="icon uil uil-apps"></i>
                                            <div id="stage3" class="progress0 three ">
                                                <p>3</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text" style="font-family: 'Cairo', sans-serif;">{{(\App\Models\Track_status::find(3)->Status_Name )}}</p>
                                        </li>
                                        <li>
                                            <i class="icon uil uil-microsoft"></i>
                                            <div id="stage4" class="progress0 four">
                                                <p>4</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text" style="font-family: 'Cairo', sans-serif;">
                                              {{(\App\Models\Track_status::find(4)->Status_Name )}}


                                            </p>
                                        </li>


                                        <li>
                                            <i class="icon uil uil-export"></i>
                                            <div id="stage5" class="progress0 prortl five">
                                                <p>5</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text" style="font-family: 'Cairo', sans-serif;">{{(\App\Models\Track_status::find(5)->Status_Name )}}</p>
                                        </li>


                                        <li>
                                            <i class="icon uil uil-user-md"></i>
                                            <div id="stage6" class="progress0 six">
                                                <p>6</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text" style="font-family: 'Cairo', sans-serif;">{{(\App\Models\Track_status::find(6)->Status_Name )}}</p>
                                        </li>


                                        <li>
                                            <i class="icon uil uil-truck"></i>
                                            <div id="stage7" class="progress0 seven">
                                                <p>7</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text" style="font-family: 'Cairo', sans-serif;">{{(\App\Models\Track_status::find(7)->Status_Name )}}</p>
                                        </li>

                                        <li>
                                            <i class="icon uil uil-user-check"></i>
                                            <div id="stage8" class="progress0 eight">
                                                <p>8</p>
                                                <i class="uil uil-check"></i>
                                            </div>
                                            <p class="text" style="font-family: 'Cairo', sans-serif;">{{(\App\Models\Track_status::find(8)->Status_Name )}}</p>
                                        </li>

                                    </ul>


                                </div>










<div><br></div>


                          







                    <table id="example" class="table key-buttons text-md-nowrap" style=" text-align: center">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th style="font-family: 'Cairo', sans-serif;">{{ __('track.Tracking Number') }}</th>
                            <th style="font-family: 'Cairo', sans-serif;">{{ __('track.Code Number') }}</th>
                            <th style="font-family: 'Cairo', sans-serif;">{{ __('track.country') }}</th>
                            
                            <th style="font-family: 'Cairo', sans-serif;">{{ __('track.Tracking Status') }}</th>

                             @if(!auth('client')->check())
                            <th style="font-family: 'Cairo', sans-serif;">{{ __('track.User') }}</th>
                             @endif
                             <th style="font-family: 'Cairo', sans-serif;">{{ __('track.updated at') }}</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($details as $track)
                                <?php $i++; ?>
                                <tr>
                                <td>{{ $i }}</td>
                                <td style="font-family: 'Cairo', sans-serif;">{{$track->tracking_number}}</td>
                                <td style="font-family: 'Cairo', sans-serif;">{{$trackcod->code_number}}</td>
                                <td style="font-family: 'Cairo', sans-serif;">{{(\App\Models\Country::find($trackcod->country_id)->Country_Name )}}</td>
                                <td style="font-family: 'Cairo', sans-serif;">{{$track->status?$track->status->Status_Name:$track->tacking_status_id}}</td>
                                 @if(!auth('client')->check())
                                <td style="font-family: 'Cairo', sans-serif;">{{$track->user}}</td>
                                 @endif
                                <td style="font-family: 'Cairo', sans-serif;">
                                @if($track->updated_at == NULL)
                  <span class="text-danger" style="font-family: 'Cairo', sans-serif;"> No Date</span>
                   @else
                  {{Carbon\Carbon::parse($track->updated_at)->toDateString()}}

                  @endif
                                </td>
                                </tr>

                                @php
                                $stage=$track->tacking_status_id;
                                @endphp
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

<script>
    {{--$(document).ready(function() {--}}
        {{--$('#invoice_number').hide();--}}
        {{--$('input[type="radio"]').click(function() {--}}
            {{--if ($(this).attr('id') == 'type_div') {--}}
                {{--$('#invoice_number').hide();--}}
                {{--$('#type').show();--}}
                {{--$('#start_at').show();--}}
                {{--$('#end_at').show();--}}
            {{--} else {--}}
                {{--$('#invoice_number').show();--}}
                {{--$('#type').hide();--}}
                {{--$('#start_at').hide();--}}
                {{--$('#end_at').hide();--}}
            {{--}--}}
        {{--});--}}
        
        
        
         @if (isset($details))

                    @for($i=1;$i<=$stage;$i++)
                        $('#stage{{$i}}').addClass('active');
                    @endfor



       
        @endif
        
        
        
        
        

               {{--  @if (isset($details))--}}


                {{--var myConfig = {--}}
                    {{--type: "gauge",--}}
                    {{--globals: {--}}
                        {{--fontSize: 6--}}
                    {{--},--}}
                    {{--plotarea: {--}}
                        {{--marginTop: 50--}}
                    {{--},--}}
                    {{--plot: {--}}
                        {{--size: '100%',--}}
                        {{--valueBox: {--}}
                            {{--placement: 'center',--}}
                            {{--text: '%v', //default--}}
                            {{--fontSize: 35,--}}
                            {{--rules: [--}}
                                {{--@foreach(\App\Models\Track_status::orderBy('id','desc')->get() as $value)--}}
                                {{--{--}}
                                {{--rule: '%v <= {{$value->id}}',--}}
                                {{--text: '%v<br>{{$value->Status_Name}}'--}}
                            {{--},--}}
                               {{--@endforeach--}}
                            {{--]--}}
                        {{--}--}}
                    {{--},--}}
                    {{--tooltip: {--}}
                        {{--borderRadius: 5--}}
                    {{--},--}}
                    {{--scaleR: {--}}
                        {{--aperture: 180,--}}
                        {{--minValue: 1,--}}
                        {{--maxValue: 8,--}}
                        {{--step: 1,--}}
                        {{--center: {--}}
                            {{--visible: false--}}
                        {{--},--}}
                        {{--tick: {--}}
                            {{--visible: false--}}
                        {{--},--}}
                        {{--item: {--}}
                            {{--offsetR: 0,--}}
                            {{--rules: [{--}}
                                {{--rule: '%i == 9',--}}
                                {{--offsetX: 15--}}
                            {{--}]--}}
                        {{--},--}}
                        {{--labels: [--}}
                            {{--@foreach(\App\Models\Track_status::all() as $item)--}}
                                {{--'{{$item->Status_Name}}',--}}
                            {{--@endforeach--}}
                        {{--],--}}
                        {{--ring: {--}}
                            {{--size: 50,--}}
                            {{--rules: [{--}}
                                {{--rule: '%v <= 1',--}}
                                {{--backgroundColor: '#E53935'--}}
                            {{--},--}}
                                {{--{--}}
                                    {{--rule: '%v > 1 && %v < 3',--}}
                                    {{--backgroundColor: '#EF5350'--}}
                                {{--},--}}
                                {{--{--}}
                                    {{--rule: '%v > 2 && %v < 4',--}}
                                    {{--backgroundColor: '#FFA726'--}}
                                {{--},--}}
                                {{--{--}}
                                    {{--rule: '%v > 3 && %v < 5',--}}
                                    {{--backgroundColor: '#efff43'--}}
                                {{--},--}}
                                {{--{--}}
                                    {{--rule: '%v > 4 && %v < 6',--}}
                                    {{--backgroundColor: '#baffab'--}}
                                {{--},--}}
                                {{--{--}}
                                    {{--rule: '%v > 5 && %v < 7',--}}
                                    {{--backgroundColor: '#29B6F6'--}}
                                {{--},--}}
                                {{--{--}}
                                    {{--rule: '%v > 6 && %v < 8',--}}
                                    {{--backgroundColor: '#f693e6'--}}
                                {{--},--}}
                                {{--{--}}
                                    {{--rule: '%v > 7',--}}
                                    {{--backgroundColor: '#1ec928'--}}
                                {{--}--}}
                            {{--]--}}
                        {{--}--}}
                    {{--},--}}
                    {{--refresh: {--}}
                        {{--type: "feed",--}}
                        {{--transport: "js",--}}
                        {{--url: "feed()",--}}
                        {{--interval: 1500,--}}
                        {{--resetTimeout: 1000--}}
                    {{--},--}}
                    {{--series: [{--}}
                        {{--values: [{{$stage}}], // starting value--}}
                        {{--backgroundColor: 'black',--}}
                        {{--indicator: [10, 10, 10, 10, 0.75],--}}
                        {{--animation: {--}}
                            {{--effect: 2,--}}
                            {{--method: 1,--}}
                            {{--sequence: 4,--}}
                            {{--speed: 900--}}
                        {{--},--}}
                    {{--}]--}}
                {{--};--}}

        {{--zingchart.render({--}}
            {{--id: 'myChart',--}}
            {{--data: myConfig,--}}
            {{--height: '100%',--}}
            {{--width: '100%',--}}
        {{--});--}}
    {{--});--}}
    {{--@endif--}}
</script>
<!--
<script type="text/javascript">
   function printDiv() {
			var printContents = document.getElementById('print').innerHTML;
			var originalContents = document.body.innerHTML;
	      document.body.innerHTML = printContents; 
	   document.body.innerHTML = originalContents; 
            var value = {"Html_code": printContents }
            window.webkit.messageHandlers.print.postMessage(value);
         
            window.print();
           
			
        }
    </script> -->


<script type="text/javascript">
        function printDiv() {
			var printContents = document.getElementById('print').innerHTML;
			var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents; 
            window.print();
           var value = {"Html_code": printContents }
window.webkit.messageHandlers.print.postMessage(value);
			
        }
    </script>  



 <!--<script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
			 console.log('print');
            
            document.body.innerHTML = originalContents;
        var value = {"print":originalContents , "fun":"print"}

                   try {
                       webkit.messageHandlers.sumbitToiOS.postMessage(value);
                      // webkit.messageHandlers.refreshWebPage.postMessage(dictionary);

               } catch(err) {
                       console.log('error');
                    }
                           
                           location.reload();

        
        }
    </script> -->

@endsection
