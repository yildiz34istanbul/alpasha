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
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;">  {{ __('track.request_delete_account') }}  </h4>
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

 <h4 style="font-family: 'Cairo', sans-serif;"> {{ __('track.Our_dear_customer') }}
 <span style="font-family: 'Cairo', sans-serif;font-size:16px;line-height:22px;text-align:center;color:#ff3984;font-weight:bold;"> {{$client->name}} </span>

 </h4>


  <br>
  <h4 style="font-family: 'Cairo', sans-serif;"> {{ __('track.you_are_submitting_request_delete_account') }} </h4>
  <br>
  <form method="post" action="{{ route('ClientDelete.Account') }}" >
	 	@csrf
  <div class="form-group">
    <label for="exampleFormControlInput1" style="font-family: 'Cairo', sans-serif;"> {{ __('track.email') }} </label>
    <input type="email" name="email" class="form-control" value="{{$client->email}}" class="form-control" required=""  placeholder="{{$client->email}}">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1" style="font-family: 'Cairo', sans-serif;"> {{ __('track.Code Number_client') }} </label>
    <input type="number" name="code_number" value="{{$client->code_number}}" class="form-control" required="" placeholder="{{$client->code_number}}">
  </div>

  <div class="form-group">
    <label for="exampleFormControlSelect1" style="font-family: 'Cairo', sans-serif;">   {{ __('track.Why_delete_your_account') }}  </label>
    <select  name="why" class="form-control" required="" style="padding: 5px;" >
      <option value="{{ __('track.My_business_suspended') }}">{{ __('track.My_business_suspended') }}</option>
      <option value="{{ __('track.products_not_available') }}"> {{ __('track.products_not_available') }} </option>
      <option value="{{ __('track.my_shipping_personal') }}">  {{ __('track.my_shipping_personal') }}  </option>
      <option value=" {{ __('track.country_not_available') }}"> {{ __('track.country_not_available') }} </option>
      <option value="{{ __('track.other') }}">{{ __('track.other') }} </option>

    </select>
  </div>

  <div class="form-group">
    <label for="exampleFormControlTextarea1" style="font-family: 'Cairo', sans-serif;"> {{ __('track.other_notes') }}  </label>
    <textarea  name="other" class="form-control"  rows="3"  required="" ></textarea>
  </div>
  <div class="text-xs-right">
	 <input type="submit" class="btn btn-rounded btn-info mb-5" value="{{ __('track.Send') }} ">
						</div>
</form>





<!--card end-->

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
