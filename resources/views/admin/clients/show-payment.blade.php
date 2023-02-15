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
                            <th>{{ __('track.Code Number') }}</th>
                            <th>{{ __('track.current_balance') }}</th>
                            <th>{{ __('track.Paid_balance') }}</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>

                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>


                                <td>{{ $client->code_number }} </td>

                                <td class="p-3 mb-2 bg-info text-white"> {{$Account_Debit - $Account_credit}} $ </td>
                                <td>{{$Account_credit}} $</td>


                            </tr>
  <!--   edit user and delet       -->



                            <!-- edit_modal_client -->
                            <div class="modal fade" id="" tabindex="-1" role="dialog"
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
                <form action="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="tracking_number" class="mr-sm-2">{{ __('track.user_name') }}
                                </label>
                                <input id="id" type="hidden" name="id" class="form-control"
                                                            value="">
                            <input id="name" type="text" name="name" class="form-control" value="">

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








                             <!-- add payment _modal_client -->
                             <div class="modal fade" id="" tabindex="-1" role="dialog"
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

                                        <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="tracking_number" class="mr-sm-2"> اضافةدفعات مالية  في حساب العميل :
                                </label>
                                <input id="id" type="hidden" name="id" class="form-control"
                                                            value="">
                                                            <div class="form-group">
    <label for="exampleFormControlFile1">Example file input</label>
    <input type="file" class="form-control-file" name="file">
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
