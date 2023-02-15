@extends('layouts.master')
@section('css')
    
@section('title')
    رصيد العملاء
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

                               <!-- -->

            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr class="p-3 mb-2 bg-dark text-white">
                            <th>#</th>
                            <th>#</th>
                            <th>{{ __('track.user_name') }}</th>
                            <th>{{ __('track.code number') }}</th>
                            <th>{{ __('track.country') }}</th>
                            <th>{{ __('track.Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach($clients as $client)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>


                                <td> <img class="img-fluid avatar-small" src="{{ (!empty($client->profile_photo_path))? url('upload/client_images/'.$client->profile_photo_path):url('upload/no-image.png') }}" alt=""> </td>

                                <td> {{$client->name}} </td>
                                <td class="p-2 mb-1 bg-info text-white">{{$client->code_number}}</td>
                                <td>{{$client->country}}</td>
                                <td>


                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#active{{ $client->id }}"
                                        title="اضافة رصيد "><i class="fa fa-check"></i></button>

                                        <button style="background-color: #ffc135;" type="button" class="btn btn-info btn-sm"

title="عرض الرصيد الحالي "><a href="{{route('Payment.show',$client->id)}}"><i style="color: #ffffff;" class="fa fa-eye"></i></a></button>









                                </td>
                            </tr>
  <!--   edit user and delet       -->



                            <!-- edit_modal_client -->
                            <div class="modal fade" id="edit{{ $client->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ __('track.edit user') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                <form action="{{ route('Client.Update', $client->id)}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="tracking_number" class="mr-sm-2">{{ __('track.user_name') }}
                                </label>
                                <input id="id" type="hidden" name="id" class="form-control"
                                                            value="{{ $client->id }}">
                            <input id="name" type="text" name="name" class="form-control" value="{{ $client->name }}">

                        </div>


                    </div>








                    <div class="form-group">

                    </div>
                    <br><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{ __('track.Close') }}</button>
                <button type="submit" class="btn btn-success">{{ __('track.edit') }}</button>
            </div>
            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>








   <!-- add account_modal_client -->
   <div class="modal fade" id="active{{ $client->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                           {{ __('track.Add_new_balance') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                        <form action="{{ route('Account.add', $client->id)}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="tracking_number" class="mr-sm-2"> {{ __('track.new_balance_the_customers_account') }} : {{$client->name}} 
                                </label>
                                <input id="id" type="hidden" name="id" class="form-control"
                                                            value="{{ $client->id }}">
                                                            <input id="Debit" type="number" name="Debit" class="form-control" value="">
                        </div>

                    </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{ __('track.Close') }}</button>
                <button type="submit" class="btn btn-success">{{ __('track.submit') }} </button>
            </div>
            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>



















                             <!-- add payment _modal_client -->
                             <div class="modal fade" id="import{{ $client->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                اضافة دفعات مالية جديدة
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                        <form action="{{ route('Paument.Account.Add', $client->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="tracking_number" class="mr-sm-2"> اضافةدفعات مالية  في حساب العميل  <span class =" p-1 mb-2 bg-info text-white"> {{$client->name}} </span>
                                </label>
                                <input id="id" type="hidden" name="id" class="form-control"
                                                            value="{{ $client->id }}">
                                                            <div class="form-group">
    <label for="exampleFormControlFile1"></label>
    <input type="file" class="form-control" name="file" accept=".xlsx,.xls,.csv">
    <p>يسمح بتحميل ملفات اكسل فقط </p>


  </div>
                        </div>

                    </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{ __('track.Close') }}</button>
                <button type="submit" class="btn btn-success">{{ __('track.Add') }}</button>
            </div>
            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>













 <!--   edit user and delet       -->


                            @endforeach

                </table>
            </div>
        </div>
    </div>
</div>


<!-- add_modal_user -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">

                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->

















        </div>
    </div>
</div>

</div>
</div>

<!-- row closed -->
@endsection
@section('js')

@endsection
