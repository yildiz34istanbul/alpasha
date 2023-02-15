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

        <form method="post" action="{{ route('profile.store') }}" enctype="multipart/form-data">
	 	@csrf
					  <div class="row">
						<div class="col-12">



    <div class="row">
	<div class="col-md-6" >

		<div class="form-group">
		<h5>{{ __('track.user_name') }} <span class="text-danger">*</span></h5>
		<div class="controls">
	 <input type="text" name="name" class="form-control" value="{{ $user->name }}" required="">  </div>

	</div>

	</div> <!-- End Col Md-6 -->

	<div class="col-md-6" >

 <div class="form-group">
		<h5>{{ __('track.email') }} <span class="text-danger">*</span></h5>
		<div class="controls">
	 <input type="email" name="email" class="form-control" value="{{ $user->email }}" required="">  </div>

	</div>

	</div><!-- End Col Md-6 -->


</div> <!-- End Row -->





<div class="row">
	<div class="col-md-6" >
    <div class="form-group">
    <label for="locale" class="mr-sm-2">{{ __('track.notification_language') }}
                                </label>
                                <select  style="padding: 2px;" class="form-control"  name="locale" aria-label="Default select example">
                                <option value="ar">Ar</option>
                                <option value="tr">Tr</option>
                                <option value="en">En</option>

</select>

          </div>
	</div> <!-- End Col Md-6 -->









    <div class="col-md-6" >
	<div class="form-group">
		<h5>{{ __('track.Profile Image') }} <span class="text-danger">*</span></h5>
		<div class="controls">
	 <input type="file" name="image" accept="image/*" class="form-control" id="image" >  </div>
	 </div>

	 	<div class="form-group">
		<div class="controls">
	<img id="showImage" src="{{ (!empty($user->profile_photo_path))? url('upload/user_images/'.$user->profile_photo_path):url('upload/no-image.png') }}" style="width: 100px; width: 100px; border: 1px solid #000000;">

	 </div>





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
<script type="text/javascript">
	$(document).ready(function(){
		$('#image').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImage').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>

@endsection
