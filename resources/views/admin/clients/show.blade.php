@extends('layouts.master')
@section('css')
  
@section('title')
    معلومات العميل
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
   عرض بيانات العميل
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">

                    <div class="card-body">













                    <div class="row">
                        <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 mb-1">

                                        <label for="inputEmail3" class="col-sm-2 col-form-label">{{ __('track.user_name') }} </label>
                                        <input type="text" class="form-control" value="{{ $client->name }}"  readonly="">

                                        <label for="inputEmail3" class="col-sm-2 col-form-label">{{ __('track.email') }}</label>
                                        <input type="text" class="form-control" value="{{$client->email}}"  readonly="">

                                        <label for="inputEmail3" class="col-sm-2 col-form-label">{{ __('track.Mobile_number') }}</label>
                                        <input type="text" class="form-control" value="{{ $client->phone }}"  readonly="">


                                        <label for="inputEmail3" class="col-sm-2 col-form-label">{{ __('track.Code Number_client') }}</label>
                                        <input type="text" class="form-control" value="{{ $client->code_number }}"  readonly="">

                                        <label for="inputEmail3" class="col-sm-2 col-form-label">{{ __('track.country') }}</label>
                                        <input type="text" class="form-control" value="{{ $client->country }}"  readonly="">

                                        <label for="inputEmail3" class="col-sm-2 col-form-label">{{ __('track.City') }}</label>
                                        <input type="text" class="form-control" value="{{ $client->city }}"  readonly="">

                                        <label for="inputEmail3" class="col-sm-2 col-form-label">{{ __('track.address') }}</label>
                                        <input type="text" class="form-control" value="{{ $client->address }}"  readonly="">

                                        <label for="inputEmail3" class="col-sm-2 col-form-label">{{ __('track.Account_Status') }}</label>
                                        @if($client->status == 1)
                                <span class=" badge badge-success">{{ __('track.Enabled') }} </span>

                                @else
                                <span class="badge badge-danger"> {{ __('track.Not_enabled') }} </span>
                                @endif

                                   <br>

                                        <label for="inputEmail3" class="col-sm-2 col-form-label">{{ __('track.notification_language') }}</label>
                                        <input type="text" class="form-control" value="{{ $client->locale }}"  readonly="">

                                        <label for="inputEmail3" class="col-sm-2 col-form-label">{{ __('track.date_of_registration') }}</label>
                                        <input type="text" class="form-control" value="{{ $client->created_at }}"  readonly="">



                                                                                <div class="col-md-12 col-12 row mt-1">
                                            <div class="form-group col-12">

                                            </div>
                                        </div>
                                                                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                        <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                            <label for="itemfile1">{{ __('track.ID_photo') }}</label>
                                 @if(!empty($client->id_photo))
                                            <div class="card" style="width: 18rem;">
                                            <a href="{{  asset('upload/client/idphoto/'.$client->id_photo)}}">  <img class="card-img-top"

                                            src="{{  asset('upload/client/idphoto/'.$client->id_photo)}}"
                                              width="300" height="200" ></a>
                                              </div>
                                              @endif




                            </div>
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
