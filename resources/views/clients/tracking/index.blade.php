@extends('layouts.master')
@section('css')
<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">

@section('title')
    {{ __('track.All Tracking') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ __('track.All Tracking') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">


@if ($errors->any())
    <div class="error">{{ $errors->first('Name') }}</div>
@endif



<div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session('success'))
                              <div class="alert alert-success alert-dismissible fade show" role="alert">
                              <strong>{{session('success')}}</strong>
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                                @endif



            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead >
                        <tr class="p-3 mb-2 bg-dark text-white">
                            <th>#</th>
                            <th style="font-family: 'Cairo', sans-serif">{{ __('track.Tracking Number') }}</th>
                            <th style="font-family: 'Cairo', sans-serif">{{ __('track.Code Number_client') }}</th>
                            <th style="font-family: 'Cairo', sans-serif">{{ __('track.Tracking Status') }}</th>
                            <th style="font-family: 'Cairo', sans-serif">{{ __('track.tracking_Method') }}</th>
                            <th style="font-family: 'Cairo', sans-serif">{{ __('track.country') }}</th>
                            <th style="font-family: 'Cairo', sans-serif">{{ __('track.type tracking') }}</th>

                            <th style="font-family: 'Cairo', sans-serif">{{ __('track.Number_of_cartons') }} </th>
                            <th style="font-family: 'Cairo', sans-serif">{{ __('track.the_number_pieces') }}</th>
                            <th style="font-family: 'Cairo', sans-serif">{{ __('track.tracking_value') }} </th>
                           <th style="font-family: 'Cairo', sans-serif"> {{ __('track.weight') }} </th>
                            <th style="font-family: 'Cairo', sans-serif">{{ __('track.date_of_arrival') }}</th>
                            <th style="font-family: 'Cairo', sans-serif">{{ __('track.Notes') }} </th>
                            <th style="font-family: 'Cairo', sans-serif">{{ __('track.updated at') }} </th>
                            <th style="font-family: 'Cairo', sans-serif"> {{ __('track.Invoices') }}</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach($track as $tracks)
                            <tr>
                                <?php $i++; ?>
                                <td class="p-2 m-2">{{ $i }}</td>
                                <td class="p-2 m-2">{{$tracks->tracking_number}}</td>
                                <td class="p-2 m-2">{{$tracks->code_number}}</td>
                               <td class="p-2 m-2">
                                @if($tracks->tacking_status_id == 1)
                                   <span style="padding: 5px;background-color:#FF5722;color:#fff;"> {{$tracks->status->Status_Name}} </span>
                                @elseif($tracks->tacking_status_id == 2)
                                <span style="padding-right: 5px;padding-left: 5px;background-color:#607D8B;color:#fff;"> {{$tracks->status->Status_Name}} </span>
                                @elseif($tracks->tacking_status_id == 3)
                                <span style="padding-right: 5px;padding-left: 5px;background-color:#795548;color:#fff;"> {{$tracks->status->Status_Name}} </span>
                                @elseif($tracks->tacking_status_id == 4)
                                <span style="padding-right: 5px;padding-left: 5px;background-color:#E91E63;color:#fff;"> {{$tracks->status->Status_Name}} </span>
                                @elseif($tracks->tacking_status_id == 5)
                                <span style="padding-right: 5px;padding-left: 5px;background-color:#3F51B5;color:#fff;"> {{$tracks->status->Status_Name}} </span>
                                @elseif($tracks->tacking_status_id == 6)
                                <span style="padding-right: 5px;padding-left: 5px;background-color:#9C27B0;color:#fff;"> {{$tracks->status->Status_Name}} </span>
                                @elseif($tracks->tacking_status_id == 7)
                                <span style="padding-right: 5px;padding-left: 5px;background-color:#F44336;color:#fff;"> {{$tracks->status->Status_Name}} </span>
                                @elseif($tracks->tacking_status_id == 8)
                                <span style="padding-right: 5px;padding-left: 5px;background-color:#4CAF50;color:#fff;"> {{$tracks->status->Status_Name}} </span>
                                @endif
                                </td>
                                <td>{{$tracks->trackmethod->method_name}}</td>
                                <td class="p-2 m-2">{{$tracks->Country->Country_Name}}</td>
                                <td>{{$tracks->tracktype->tracking_type_name}}</td>
                                <td>{{$tracks->cartons_number}}</td>
                                <td>{{$tracks->pieces_number}}</td>
                                <td>{{$tracks->invoice_value}} $</td>
                               <td>{{$tracks->weight}} KG</td>
                                <td>


                                @if($tracks->arrival_time == NULL)
                  <span class="text-danger">{{ __('track.no_data') }}  </span>
                   @else
                  {{Carbon\Carbon::parse($tracks->arrival_time)->toDateString()}}

                  @endif

</td>

 <td>{{$tracks->notes}}</td>


                                <td>
                                @if($tracks->updated_at == NULL)
                  <span class="text-danger"> No Date</span>
                   @else
                  {{Carbon\Carbon::parse($tracks->updated_at)->toDateString()}}

                  @endif
                                </td>
                                 <td>
                                <a class="btn btn-outline-info btn-sm" href="{{route('Track.invoice',$tracks->id)}}" >
                                        <i class="fa fa-download"></i> {{ __('track.Invoices') }} </a>
                                </td>

                            </tr>



                            @endforeach

                </table>
            </div>
        </div>
    </div>
</div>


<!-- add_modal_Grade -->



                        </div>

                    </div>



    </div>
</div>

</div>

<!-- row closed -->
@endsection
@section('js')





@endsection
