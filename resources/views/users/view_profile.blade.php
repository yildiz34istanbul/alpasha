@extends('layouts.master')
@section('css')
    
@section('title')
    {{ __('track.Users') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ __('track.Users') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">





<div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body">





                        <div class="col-9">

                        <div class="card" style="width: 18rem;">
                        <img class="card-img-top"
   src="{{ (!empty($user->profile_photo_path))? url('upload/user_images/'.$user->profile_photo_path):url('upload/no-image.png') }} " alt="User Avatar">
  <div class="card-body">
    <h5 class="card-title">{{ __('track.user_name') }} : {{ $user->name }}</h5>
    <p class="card-text">{{ __('track.email') }} : {{ $user->email }}</p>
  </div>

  <div class="card-body">
  <a href="{{ route('profile.edit') }}"  class="btn btn-rounded btn-success mb-5">{{ __('track.Edit Profile') }} </a>

  </div>
</div>




















</div>









</div>
</div>













</div>
<br><br><br>

<!-- row closed -->
@endsection
@section('js')

@endsection
