@extends('layouts.master')
@section('css')

@section('title')
{{ __('track.request_delete_account') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;"> {{ __('track.request_delete_account') }}</h4>
            <br>
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




  <br>
  <h4 style="font-family: 'Cairo', sans-serif;font-size:20px;line-height:22px;text-align:center;color:#ff3984;font-weight:bold;"> {{ __('track.Your_request_has_been_sent') }} </h4>





<!--card end-->

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
