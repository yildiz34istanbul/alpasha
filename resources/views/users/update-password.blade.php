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
        @if(session('errors'))
                              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              <strong>{{session('errors')}}</strong>
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                                @endif

        <div class="col-9">

        <form method="post" action="{{ route('password.update') }}" >
	 	@csrf
					  <div class="row">
						<div class="col-12">



    <div class="row">
	<div class="col-md-6" >

		<div class="form-group">
		<h5>{{ __('track.Current Password') }} <span class="text-danger">*</span></h5>
		<div class="controls">
	 <input id="current_password" type="password" name="oldpassword" class="form-control" value="" required="">  </div>

	</div>

	</div> <!-- End Col Md-6 -->

	<div class="col-md-6" >

 <div class="form-group">
		<h5>{{ __('track.New Password') }} <span class="text-danger">*</span></h5>
		<div class="controls">
	 <input id="password" type="password" name="password" class="form-control" value="" required="">  </div>

	</div>

	</div><!-- End Col Md-6 -->


</div> <!-- End Row -->





<div class="row">
	<div class="col-md-6" >
    <div class="form-group">
    <label for="locale" class="mr-sm-2">{{ __('track.Confirm Password') }}<span class="text-danger">*</span>
                                </label>
                                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" value="{{ $user->email }}" required="">


          </div>
	</div> <!-- End Col Md-6 -->


	 </div>


	</div><!-- End Col Md-6 -->

</div>





						<div class="text-xs-right">
	 <input type="submit" class="btn btn-rounded btn-info mb-5" value="{{ __('track.edit') }}">
						</div>

					</form>




        </div>

</div>



</div> <!-- End Row -->


</div>


</div>

<!-- row closed -->
@endsection
@section('js')


@endsection
