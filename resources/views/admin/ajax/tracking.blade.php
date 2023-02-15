
@extends('layouts.master')
@section('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" />




@section('title')

  {{ __('track.All Tracking') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
   tracking
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">







   <!-- add value tracking-->

<!---->







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

                    <button type="button" class="button x-small" data-toggle="modal" data-target="#formModal">
                     {{ __('track.Add Tracking Number') }}
                    </button>

                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table yajra-datatable table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr class="p-2 mb-2 bg-dark text-white">

                            <th>#</th>
                            <th>{{ __('track.Tracking Number') }}</th>
                            <th>{{ __('track.Code Number') }}</th>
                            <th style=" width: 90px;">{{ __('track.Tracking Status') }}</th>
                            <th>طريقة الشحن</th>

                            <th>{{ __('track.country') }}</th>
                            <th>{{ __('track.type tracking') }}</th>
                            <th>عدد الكراتين</th>
                            <th>عدد القطع</th>
                            <th>الوزن </th>
                            <th>قيمة الشحنة</th>
                            <th>تخمين الوصول </th>
                             <th> الملاحظات </th>

                            <th>{{ __('track.Created at') }}</th>
                            <th>{{ __('track.Action') }}</th>
                            </tr>
                            </thead>

        <tbody>
        </tbody>
    </table>







<!--  track modal -->




{{-- add value modal --}}


<div class="modal fade addvalue"  id="addvaluemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('update.track.value')}}" method="post" id="update-value-form" >
            @csrf
                <div class="modal-content">

                    <div class="modal-body">


                        <div class="form-group">


                            <label for="invoice_value" class="mr-sm-2">قيمة الشحنة  $
                    </label>

                <input type="decimal" required class="form-control" name="invoice_value" id="invoice_value" value="">
                            <input type="hidden" name="id" id="id">
                            <input  type="hidden" name="code_number"  id="code_number" class="form-control"
                                                value="">

                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">{{ __('words.close') }}</button>
                        <button type="submit" class="btn btn-danger">Add  </button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>



    {{--  end add value modal --}}





    {{-- Edite  tracking DETAILS modal --}}


<div class="modal fade editedetails"  id="editedetailsmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('Edite.DetailsTrack')}}" method="post" id="edite-details-form" >
            @csrf
                <div class="modal-content">

                <div class="modal-header">
                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                    id="exampleModalLabel">
                                تعديل عدد القطع والكراتين وتاريخ الوصول
                                </h5>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                    <div class="modal-body">


                        <div class="form-group">


                        <div class="row">



<div class="col">
<input type="hidden" name="id" id="id">
<input  type="hidden" name="code_number"  id="code_number" class="form-control" value="">

                <label for="cartons_number" class="mr-sm-2">عدد الكراتين  </label>

                <input id="cartons_number" type="number" name="cartons_number" class="form-control" value="">

            </div>
            <div class="col">
            <label for="arrival_time" class="mr-sm-2">تخمين الوصول
                    </label>
                <input id="arrival_time" type="date" name="arrival_time" class="form-control" value="">
            </div>
            </div>



            <div class="col">
            <label for="pieces_number" class="mr-sm-2">عدد القطع
                    </label>
                <input id="pieces_number" type="number" name="pieces_number" class="form-control" value="">


            </div>


 <div class="col">
            <label for="weight" class="mr-sm-2">الوزن </label>
             <input id="weight" type="text" name="weight" class="form-control" value="">


            </div>
            <div class="col">
            <label for="notes" class="mr-sm-2">الملاحظات </label>

            <input id="notes" type="text" name="notes" class="form-control" value="">


            </div>





</div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">{{ __('words.close') }}</button>
                        <button type="submit" class="btn btn-danger">Add  </button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>



    {{--  end edite  tracking DETAILS modal --}}


<!-- Update status modal  -->

{{-- Update status modal --}}


<div class="modal fade updatestatus"  id="updatestatusmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('Update.Stetus.track')}}" method="post" id="update-status-form" >
            @csrf
                <div class="modal-content">
                <div class="modal-header">
                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                    id="exampleModalLabel">
                                  update status
                                </h5>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                    <div class="modal-body">


                        <div class="form-group">

                        <div class="row">
            <div class="col">
                <label for="tracking_number" class="mr-sm-2">{{ __('track.Tracking Number') }}
                    </label>


                <input id="tracking_number1" type="number" name="tracking_number1" class="form-control" value=""disabled >

            </div>
            <div class="col">
                <label for="code_number" class="mr-sm-2">{{ __('track.Code Number') }}
                    </label>
                <input type="number" class="form-control"  id="code_number2" name="code_number1" value="" disabled>

            </div>

        </div>

             <input type="hidden" name="id" id="id">
              <input  type="hidden" name="code_number"  id="code_number" class="form-control"   value="">
              <input  type="hidden" name="tracking_number"  id="tracking_number" class="form-control" value="">


                                                <label for="tacking_status_id" class="mr-sm-2">{{ __('track.Tracking Status') }}
                    </label>
                    <select id ="selstatus" class="form-control selstatus"  name="tacking_status_id" aria-label="Default select example" value="">
                    <option  value=""></option>
                @foreach($Track_sta as $status)
                    <option value="{{$status->id}}">{{$status->Status_Name}}</option>





                @endforeach
</select>

                        </div>

                        <div class="col">
                <label for="tacking_status_id" class="mr-sm-2">طريقة الشحن
                    </label>


                    <select id ="selstatus2" class="form-control selstatus"  name="track_method_id" aria-label="Default select example" value="">
                    <option  value=""></option>
                            @foreach($TrackMethod as $method)
                                <option value="{{$method->id}}">{{$method->method_name}}</option>
                            @endforeach
</select>

</div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">{{ __('words.close') }}</button>
                        <button type="submit" class="btn btn-danger">Add  </button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>



    {{--  end Update status modal modal --}}

<!--  Update status modal -->



<!-- add_modal_tracking -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                {{ __('track.Add Tracking Number') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('ajax.story') }}"  method="POST"  id="add-Tracking-form" >
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="tracking_number" class="mr-sm-2">{{ __('track.Tracking Number') }}
                                </label>
                            <input id="tracking_number" type="number" name="tracking_number" class="form-control">
                            <span class="text-danger error-text tracking_number_error"></span>
                        </div>
                        <div class="col">
                            <label for="code_number" class="mr-sm-2">{{ __('track.Code Number') }}
                                </label>
                            <input type="number" class="form-control" name="code_number" id="code_number">
                            <span class="text-danger error-text code_number_error"></span>
                        </div>

                    </div>
                    <div class="col">
                            <label for="tacking_status_id" class="mr-sm-2">{{ __('track.Tracking Status') }}
                                </label>
                                <select class="form-control" id="tacking_status_id" name="tacking_status_id" aria-label="Default select example">
                        <option selected>...</option>
                            @foreach($Track_sta as $status)
                                <option value="{{$status->id}}">{{$status->Status_Name}}</option>
                            @endforeach
</select>
                        </div>
                        <div class="col">
                            <label for="track_method_id" class="mr-sm-2">طريقة الشحن
                                </label>
                                <select class="form-control" id="track_method_id" name="track_method_id" aria-label="Default select example">
                        <option selected>...</option>
                            @foreach($TrackMethod as $method)
                                <option value="{{$method->id}}">{{$method->method_name}}</option>
                            @endforeach
</select>
                        </div>


                        <div class="row">
                        <div class="col">
                            <label for="country_id" class="mr-sm-2">{{ __('track.country') }}
                                </label>
                                <select class="form-control" id="country_id" name="country_id" aria-label="Default select example">
                        <option selected>...</option>
                        @foreach($Countrys as $Country)
                                <option value="{{$Country->id}}">{{$Country->Country_Name}}</option>
                            @endforeach
</select>

                        </div>
                        <div class="col">
                            <label for="type_tracking_id" class="mr-sm-2">{{ __('track.type tracking') }}
                                </label>
                                <select class="form-control" id="type_tracking_id" name="type_tracking_id" aria-label="Default select example">
                                <option selected>...</option>
                        @foreach($trackTypes as $trackType)
                                <option value="{{$trackType->id}}">{{$trackType->tracking_type_name}}</option>
                            @endforeach
</select>


                        </div>

                    </div>





  <div class="row">

<div class="col">
                <label for="cartons_number" class="mr-sm-2">عدد الكراتين
                    </label>

                <input id="cartons_number" type="number" name="cartons_number" class="form-control" value="">

            </div>
            <div class="col">
            <label for="arrival_time" class="mr-sm-2">عدد القطع
                    </label>

                <input id="pieces_number" type="number" name="pieces_number" class="form-control" value="">
            </div>
            </div>


<div class="row">

<div class="col">
    <label for="weight" class="mr-sm-2">الوزن
        </label>

    <input id="weight" type="number" name="weight" class="form-control" value="">

</div>

<div class="col">
    <label for="arrival_time" class="mr-sm-2">تخمين الوصول
        </label>

    <input id="arrival_time" type="date" name="arrival_time" class="form-control" value="">

</div>

</div>

<div class="row">

<div class="col">
    <label for="notes" class="mr-sm-2">الملاحظات
        </label>

    <input id="notes" type="text" name="notes" class="form-control" value="">

</div>

</div>

                    <div class="form-group">

                    </div>
                    <br><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary closeUpdate"
                    data-dismiss="modal">{{ __('track.Close') }}</button>
                <button  onClick="onBtnClick()"  type="submit" class="btn btn-success">{{ __('track.submit') }}</button>
            </div>
            </form>

        </div>

    </div>








</div>

<!--  end add new tracking   -->






<!--    -->

@endsection
@section('js')


<script type="text/javascript">




/// get all  tracking

  $(function () {
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
		"order": [[ 13, "desc" ]],
        dom: 'Bfrtip',

        ajax: "{{ route('get.ajax.Track') }}",
        columns: [

            {data: 'id', name: 'id'},
          //  {data:'DT_RowIndex', name:'DT_RowIndex'},
           {data: 'tracking_number', name: 'tracking_number',searchable: true},
            {data: 'code_number', name: 'code_number',searchable: true},
            {data: 'Status_Name', name: 'Status_Name',searchable: false},
            {data: 'track_method', name: 'track_method',searchable: false },

            {data: 'Country', name: 'Country',searchable: true},
            {data: 'type_tracking', name: 'type_tracking',searchable: false},
            {data: 'cartons_number', name: 'cartons_number',searchable: true},
            {data: 'pieces_number', name: 'pieces_number',searchable: false},
            {data: 'weight', name: 'weight',searchable: false},
            {data: 'invoice_value', name: 'invoice value',searchable: false},
            {data: 'arrival_time', name: 'arrival_time',searchable: false},
            {data: 'notes', name: 'notes',searchable: false },




            {data: 'created_at', name: 'created_at'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },

            ] ,

        columnDefs: [
            {
            // For Responsive
            responsivePriority: 4,
            targets: 0
            },
            {
                targets: 9,
                render: function (data, type, full) {
                    var weight= full["weight"];
                    if (weight == null) {
                        return '<span >  KG</span>';
                    }
                        return '<span >'+weight+' </span> KG ';


                }
            },
            {
                targets: 10,
                render: function (data, type, full) {
                    var invoice_value= full["invoice_value"];
                    if (invoice_value == null) {
                        return '<span >  $</span>';
                    }
                        return '<span >'+invoice_value+' $</span>';


                }
            },
            {
                targets: 3,
                render: function (data, type, full) {
                    var text = full['tacking_status_id'];
                    var Status_Name = full['Status_Name'];

                    if (text == 1) {
           return '<span  style="padding-right: 5px;padding-left: 5px;background-color:#FF5722;color:#fff;">'+Status_Name+'</span>';
        }

        if (text == 2) {
            return '<span  style="padding: 5px;background-color:#607D8B;color:#fff;">'+Status_Name+'</span>';
        }
        if (text == 3) {
            return '<span  style="padding: 5px;background-color:#795548;color:#fff;">'+Status_Name+'</span>';
        }
        if (text == 4) {
            return '<span  style="padding: 5px;background-color:#E91E63;color:#fff;">'+Status_Name+'</span>';
        }
        if (text == 5) {
            return '<span  style="padding: 5px;background-color:#3F51B5;color:#fff;">'+Status_Name+'</span>';
        }
        if (text == 6) {
            return '<span  style="padding: 5px;background-color:#9C27B0;color:#fff;">'+Status_Name+'</span>';
        }
        if (text == 7) {
            return '<span  style="padding-right: 5px;padding-left: 5px;background-color:#F44336;color:#fff;">'+Status_Name+'</span>';
        }
        if (text == 8) {
            return '<span  style="padding: 5px;background-color:#4CAF50;color:#fff;">'+Status_Name+'</span>';
        }


                }
            },

            {
                targets: 4,
                render: function (data, type, full) {
                    var track_method_id = full["track_method_id"];
                    var track_method = full["track_method"];
                    return track_method;

                }
            },
            {
                targets: 6,
                render: function (data, type, full) {
                    var type_tracking_id = full["type_tracking_id"];
                    var type_tracking = full["type_tracking"];
                    return type_tracking;

                }
            },

        ],



    });

  setTimeout( function () {
    table.processing( false );
  }, 200 );

});

///  end get all  tracking




// add value track


$(document).on('click','#addvalue', function(){
                    var track_id = $(this).data('id');
                  //  var id = $(this).attr("data-id");
                    $('.addvalue').find('form')[0].reset();
                    $('.addvalue').find('span.error-text').text('');
                   $.post('<?= route("get.track.details") ?>',{track_id:track_id}, function(data){
                        //  alert(data.details.invoice_value);
                          $('#addvaluemodal #id').val(track_id);
                          $('#addvaluemodal #invoice_value').val(data.details.invoice_value);
                          $('#addvaluemodal #code_number').val(data.details.code_number);
                   },'json');
                });



/// end add value  track

   //UPDATE value  track
   $('#update-value-form').on('submit', function(e){
                    e.preventDefault();
                    var form = this;
                    $.ajax({
                        url:$(form).attr('action'),
                        method:$(form).attr('method'),
                        data:new FormData(form),
                        processData:false,
                        dataType:'json',
                        contentType:false,
                        beforeSend: function(){
                             $(form).find('span.error-text').text('');
                        },
                        success: function(data){
                              if(data.code == 0){
                                  $.each(data.error, function(prefix, val){
                                      $(form).find('span.'+prefix+'_error').text(val[0]);
                                  });
                              }else{
                                  $('#datatable').DataTable().ajax.reload(null, false);
                                  $('#addvaluemodal').modal('hide');
                                  $('.addvalue').find('form')[0].reset();
                                  toastr.success(data.msg);
                              }
                        }
                    });
                });


    // end UPDATE value  track



    // edite datiles track


$(document).on('click','#editedetails', function(){
                    var track_id = $(this).data('id');
                  //  var id = $(this).attr("data-id");
                    $('.editedetails').find('form')[0].reset();
                    $('.editedetails').find('span.error-text').text('');
                   $.post('<?= route("get.track.details") ?>',{track_id:track_id}, function(data){
                        //  alert(data.details.invoice_value);
                          $('#editedetailsmodal #id').val(track_id);
                          $('#editedetailsmodal #pieces_number').val(data.details.pieces_number);
                          $('#editedetailsmodal #cartons_number').val(data.details.cartons_number);
                          $('#editedetailsmodal #weight').val(data.details.weight);
                          $('#editedetailsmodal #arrival_time').val(data.details.arrival_time);
                          $('#editedetailsmodal #notes').val(data.details.notes);
                   },'json');
                });



/// end edite datiles  track

//UPDATE datiles   track
$('#edite-details-form').on('submit', function(e){
                    e.preventDefault();
                    var form = this;
                    $.ajax({
                        url:$(form).attr('action'),
                        method:$(form).attr('method'),
                        data:new FormData(form),
                        processData:false,
                        dataType:'json',
                        contentType:false,
                        beforeSend: function(){
                             $(form).find('span.error-text').text('');
                        },
                        success: function(data){
                              if(data.code == 0){
                                  $.each(data.error, function(prefix, val){
                                      $(form).find('span.'+prefix+'_error').text(val[0]);
                                  });
                              }else{
                                  $('#datatable').DataTable().ajax.reload(null, false);
                                  $('#editedetailsmodal').modal('hide');
                                  $('.editedetails').find('form')[0].reset();
                                  toastr.success(data.msg);
                              }
                        }
                    });
                });


    // end UPDATE datiles  track



  // Edit status track


$(document).on('click','#updatestatus', function(){
                    var track_id = $(this).data('id');
                  //  var id = $(this).attr("data-id");

                    $('.updatestatus').find('form')[0].reset();
                    $('.updatestatus').find('span.error-text').text('');
                   $.post('<?= route("get.track.details") ?>',{track_id:track_id}, function(data){
                        //  alert(data.details.invoice_value);
                          $('#updatestatusmodal #id').val(track_id);
                          $('#updatestatusmodal #code_number').val(data.details.code_number);
                          $('#updatestatusmodal #tracking_number').val(data.details.tracking_number);
                          $('#updatestatusmodal #code_number2').val(data.details.code_number);
                          $('#updatestatusmodal #tracking_number1').val(data.details.tracking_number);
                          $('#updatestatusmodal #selstatus').val(data.details.tacking_status_id);
                          $('#updatestatusmodal #selstatus2').val(data.details.track_method_id);
                   },'json');
                });



/// end Edit status  track

//UPDATE Stetus   track
$('#update-status-form').on('submit', function(e){
                    e.preventDefault();
                    var form = this;
                    $.ajax({
                        url:$(form).attr('action'),
                        method:$(form).attr('method'),
                        data:new FormData(form),
                        processData:false,
                        dataType:'json',
                        contentType:false,
                        beforeSend: function(){
                             $(form).find('span.error-text').text('');
                        },
                        success: function(data){
                              if(data.code == 0){
                                  $.each(data.error, function(prefix, val){
                                      $(form).find('span.'+prefix+'_error').text(val[0]);
                                  });
                              }else{

                                  $('#datatable').DataTable().ajax.reload(null, false);
                                  $('#updatestatusmodal').modal('hide');
                                  $('.editedetails').find('form')[0].reset();
                                  toastr.success(data.msg);
                              }
                        }
                    });
                });


    // end UPDATE Stetus  track




                    </script>



<script>
    // add  new Tracking
         toastr.options.preventDuplicates = true;
         $.ajaxSetup({
             headers:{
                 'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
             }
         });
         $(function(){
    $('#add-Tracking-form').on('submit', function(e){
                    e.preventDefault();
                    var form = this;
                    $.ajax({
                        url:$(form).attr('action'),
                        method:$(form).attr('method'),
                        data:new FormData(form),
                        processData:false,
                        dataType:'json',
                        contentType:false,
                        beforeSend:function(){
                             $(form).find('span.error-text').text('');
                        },
                        success:function(data){
                             if(data.code == 0){
                                   $.each(data.error, function(prefix, val){
                                       $(form).find('span.'+prefix+'_error').text(val[0]);
                                   });
                             }else{
                                 $(form)[0].reset();
                                //  alert(data.msg);

                                $('#datatable').DataTable().ajax.reload(null, false);
                                $('#formModal').modal('hide');
                                toastr.success(data.msg);
                             }
                        }
                    });
                });
            });
  // end  add new Tracking
                    </script>

						

@endsection




