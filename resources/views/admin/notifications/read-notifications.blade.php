@extends('layouts.master')
@section('css')
    
@section('title')
    {{ __('track.old_Notifications') }} 
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
الاشعارات القديمة
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
            
             <h3> {{ __('track.old_Notifications') }} </h3>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr class="p-3 mb-2 bg-dark text-white">
                              <th>#</th>
                            <th> {{ __('track.Notifications') }}</th>
                            <th> {{ __('track.date_Notifications') }} </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach(Auth::user()->readNotifications()->get() as $noty)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td style="text-align: start;"><span style="padding: 5px;font-size:15px;" >{!! $noty->data['data'] !!}</span></td>
                                 <td> {{Carbon\Carbon::parse($noty->created_at)->toDateString()}}</td>


                            </tr>





                            @endforeach

                </table>
   
            </div>
        </div>
    </div>
</div>




</div>

<!-- row closed -->
@endsection
@section('js')

@endsection
