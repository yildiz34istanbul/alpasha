@extends('layouts.master')
@section('css')
    
@section('title')
    {{ __('track.Update Tracking') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ __('track.Update Tracking') }}
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



            <br>
           <h3> {{ __('track.Update Tracking') }}</h3>
           <br>
            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr class="p-3 mb-2 bg-dark text-white">
                            <th>#</th>
                            <th>{{ __('track.Tracking Number') }}</th>
                            <th>{{ __('track.Code Number') }}</th>
                            <th>{{ __('track.Tracking Status') }}</th>
                            <th>طريقة الشحن</th>
                            <th>{{ __('track.country') }}</th>
                            <th>{{ __('track.type tracking') }}</th>
                            <th>عدد الكراتين</th>
                            <th>عدد القطع</th>
                            <th>قيمة الشحنة</th>
                            <th>تخمين الوصول </th>
                            <th>{{ __('track.User') }}</th>
                            <th>{{ __('track.updated at') }}</th>
                            <th>{{ __('track.Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach($trackings as $track)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>

                                <td>{{$track->tracking_number}}</td>
                                <td>{{$track->code_number}}</td>
                                <td class="p-2 m-2">
                               
                                @if($track->tacking_status_id == 1)
                                   <span  style="padding: 5px;background-color:#FF5722;color:#fff;"> {{$track->status->Status_Name}} </span>
                                @elseif($track->tacking_status_id == 2)
                                <span  style="padding: 5px;background-color:#607D8B;color:#fff;"> {{$track->status->Status_Name}} </span>
                                @elseif($track->tacking_status_id == 3)
                                <span  style="padding: 5px;background-color:#795548;color:#fff;"> {{$track->status->Status_Name}} </span>
                                @elseif($track->tacking_status_id == 4)
                                <span  style="padding: 5px;background-color:#E91E63;color:#fff;"> {{$track->status->Status_Name}} </span>
                                @elseif($track->tacking_status_id == 5)
                                <span  style="padding: 5px;background-color:#3F51B5;color:#fff;"> {{$track->status->Status_Name}} </span>
                                @elseif($track->tacking_status_id == 6)
                                <span  style="padding: 5px;background-color:#9C27B0;color:#fff;"> {{$track->status->Status_Name}} </span>
                                @elseif($track->tacking_status_id == 7)
                                <span style="padding: 5px;background-color:#F44336;color:#fff;"> {{$track->status->Status_Name}} </span>
                                @elseif($track->tacking_status_id == 8)
                                <span style="padding: 5px;background-color:#4CAF50;color:#fff;"> {{$track->status->Status_Name}} </span>

                                @endif

                                </td>

                                <td>{{$track->trackmethod->method_name}}</td>
                                <td>{{$track->Country->Country_Name}}</td>
                                <td>{{$track->tracktype->tracking_type_name}}</td>
                                <td>{{$track->cartons_number}}</td>
                                <td>{{$track->pieces_number}}</td>
                                <td>{{$track->invoice_value}}</td>
                                <td>

                                @if($track->arrival_time == NULL)
                  <span class="text-danger"> No Date</span>
                   @else
                  {{Carbon\Carbon::parse($track->arrival_time)->toDateString()}}

                  @endif
                                </td>
                                <td>{{$track->user->name}}</td>
                                <td>
                                @if($track->updated_at == NULL)
                  <span class="text-danger"> No Date</span>
                   @else
                  {{Carbon\Carbon::parse($track->updated_at)->toDateString()}}

                  @endif
                                </td>

                                <td>

                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $track->id }}"
                                        title="{{ __('track.add to Archives') }}"><i
                                            class="fa fa-folder-open"></i></button>
                                </td>
                            </tr>




                            <!-- add to archives -->
                            <div class="modal fade" id="delete{{ $track->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ __('track.add to Archives') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('SoftDelete', $track->id)}}" method="post">

                                                @csrf
                                                {{ __('track.Are you sure to add to the archive') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{$track->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ __('track.Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-danger">{{ __('track.add to Archives') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach

                </table>
            </div>
        </div>
    </div>
</div>


<!-- add_modal_Grade -->


</div>

<!-- row closed -->
@endsection
@section('js')

@endsection
