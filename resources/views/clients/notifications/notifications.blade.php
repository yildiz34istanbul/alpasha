@extends('layouts.master')
@section('css')
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet"> 
@section('title')
 {{ __('track.Notifications') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
 {{ __('track.Notifications') }}
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
              <h3 style="font-family: 'Cairo', sans-serif;"> {{ __('track.all_Notifications') }}</h3>


            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr class="p-3 mb-2 bg-dark text-white">
                            <th>#</th>
                            <th style="font-family: 'Cairo', sans-serif;"> {{ __('track.Notifications') }} </th>
                            <th  style="font-family: 'Cairo', sans-serif;">{{ __('track.date_Notifications') }}  </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach(Auth::guard('client')->user()->unreadNotifications()->get() as $noty)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td style="text-align: start;font-family: 'Cairo', sans-serif;"><a c href="{{route('Track.show').'?not_id='.$noty->id}}"><span style="padding: 5px;font-size:15px;" >{!! $noty->data['data'] !!}</span></a></td>
   <td> {{Carbon\Carbon::parse($noty->created_at)->toDateString()}}</td>



                            </tr>





                            @endforeach

                </table>
                <div>
  <a href="{{route('ClientMarkAsRead_all')}}" class="btn btn-success"><h6 style="color:#fff;font-family: 'Cairo', sans-serif;"> {{ __('track.red_Notifications') }}</h6></a>
  <a href="{{route('Client.notification.read')}}" class="btn btn-dark"><h6 style="color:#fff;font-family: 'Cairo', sans-serif;">{{ __('track.old_Notifications') }} </h6></a>

  </div>
            </div>
        </div>
    </div>
</div>




</div>

<!-- row closed -->
@endsection
@section('js')

@endsection
