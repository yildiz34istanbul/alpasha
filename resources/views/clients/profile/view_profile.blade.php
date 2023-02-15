@extends('layouts.master')
@section('css')
 
@section('title')
    {{ __('track.Profile') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ __('track.Profile') }}
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
   src="{{ (!empty($client->profile_photo_path))? url('upload/client_images/'.$client->profile_photo_path):url('upload/no-image.png') }} " alt="User Avatar">
  <div class="card-body">
    <h5 class="card-title" style="font-family: 'Cairo', sans-serif;">{{ __('track.user_name') }} : {{ $client->name }}</h5>
    <p class="card-text" style="font-family: 'Cairo', sans-serif;">{{ __('track.email') }} : {{ $client->email }}</p>
  </div>

  <div class="card-body">
  <a href="{{ route('Clientprofile.edit') }}" style="font-family: 'Cairo', sans-serif;" class="btn btn-rounded btn-success mb-5">{{ __('track.Edit Profile') }} </a>

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
