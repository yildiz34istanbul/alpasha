@extends('layouts.master')
@section('css')

@section('title')
customer
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> customer</h4>
        </div>
        <div class="col-sm-6">

        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">

<!--   -->

  <!-- active_modal_client -->



  {{-- status modal --}}


<div class="modal fade activestatus"  id="activemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('update.status')}}" method="post" id="active-status-form" >
            @csrf
                <div class="modal-content">

                    <div class="modal-body">


                        <div class="form-group">


                            <label for="status" class="mr-sm-2">  {{ __('track.Activate_disable_customers_account') }}
                    </label>
                    <select  class="form-control" name="status"
                                                        aria-label="Default select example">



                                                    <option value="0">{{ __('track.Not_enabled') }}</option>
                                                    <option value="1">{{ __('track.Enabled') }}</option>

                                                </select>


                            <input type="text" name="id" id="id">


                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">{{ __('track.Close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ __('track.edit') }} </button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>



    {{--  end status modal --}}



    <!--  End active_modal_client -->




 <!-- Client Notify_modal -->



 {{-- Client Notify modal --}}


<div class="modal fade clientnotify"  id="Notifymodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('Send.notify')}}" method="post" id="notify-form" >
            @csrf
                <div class="modal-content">

                    <div class="modal-body">


                        <div class="form-group">


                            <label for="status" class="mr-sm-2">   {{ __('track.send_notice') }}
                    </label>
                    <input id="text" type="text" name="text" class="form-control"
                                                       value="">


                            <input type="text" name="id" id="id">


                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">{{ __('track.Close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ __('track.edit') }} </button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>



    {{--  end Client Notify modal --}}

 <!-- End  Client Notify_modal -->




<!--  ---->

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

                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                     {{ __('track.Add_a_new_customer') }}
                    </button>

                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table yajra-datatable table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr class="p-3 mb-2 bg-dark text-white">
                                <th>#</th>
                                <th>#</th>
                                <th>{{ __('track.user_name') }}</th>
                                <th>{{ __('track.email') }}</th>
                                <th>{{ __('track.Mobile_number') }}</th>
                                <th>{{ __('track.Code Number_client') }}</th>
                                <th>{{ __('track.country') }}</th>
                                <th>{{ __('track.Account_Status') }}</th>
                                <th>{{ __('track.Created at') }}</th>
                                <th>{{ __('track.Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                    </table>
                    </div>



            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
<script type="text/javascript">


/// get all  clients

$(function () {
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        dom: 'Bfrtip',

        ajax: "{{ route('get.ajax.clients') }}",
        columns: [

            {data: 'id', name: 'id'},
            {data: 'image', name: 'image',searchable: false},
           // {data:'DT_RowIndex', name:'DT_RowIndex'},
            {data: 'name', name: 'name',searchable: true},
            {data: 'email', name: 'email',searchable: false},
            {data: 'phone', name: 'phone',searchable: false },
            {data: 'code_number', name: 'code_number',searchable: true},
            {data: 'country', name: 'country',searchable: true},
            {data: 'status', name: 'status',searchable: false},
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
                targets: 5,
                render: function (data, type, full) {
                    var code_number= full["code_number"];
                    return code_number;

                }
            },

            {
                targets: 7,
                render: function (data, type, full) {
                    var status= full["status"];

                    //return status;
                    if(status !== 0){
             return  "Enabled" ;
            }

            if(status !== 1){
                return '<span  style="padding: 5px;background-color:#E91E63;color:#fff;"> Not Enabled</span>';
        }

                }
            },

            {
                targets: 1,
                render: function (data, type, full) {
                    var text = full["image"];

                      if(text !== null){
                        return '<img src="/upload/client_images/'+text+'" width=50 height=50 />';
                      }
                      else{
                        return '<img src="/upload/no-image.png" width=50 height=50 />';
                      }


                }
            },





        ],




    });



});



///  end get all  clients

// get Client details


$(document).on('click','#activestatus', function(){
                    var Client_id = $(this).data('id');
                  //  var id = $(this).attr("data-id");
                    $('.activestatus').find('form')[0].reset();
                    $('.activestatus').find('span.error-text').text('');
                   $.post('<?= route("get.client.details") ?>',{Client_id:Client_id}, function(data){
                        //  alert(data.details.invoice_value);
                          $('#activemodal #id').val(Client_id);
                          $('#activemodal #status').val(data.details.status);
                   },'json');
                });



/// end get Client details

 //UPDATE status
 $('#active-status-form').on('submit', function(e){
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
                                  $('#activemodal').modal('hide');
                                  $('.activestatus').find('form')[0].reset();
                                  toastr.success(data.msg);
                              }
                        }
                    });
                });


    // end UPDATE status


    // get Client details


$(document).on('click','#clientnotify', function(){
                    var Client_id = $(this).data('id');
                  //  var id = $(this).attr("data-id");
                    $('.clientnotify').find('form')[0].reset();
                    $('.clientnotify').find('span.error-text').text('');
                   $.post('<?= route("get.client.details") ?>',{Client_id:Client_id}, function(data){
                        //  alert(data.details.invoice_value);
                          $('#Notifymodal #id').val(Client_id);

                   },'json');
                });



/// end get Client details




 //Send Notify to Client
 $('#notify-form').on('submit', function(e){
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
                                 // $('#datatable').DataTable().ajax.reload(null, false);
                                  $('#Notifymodal').modal('hide');
                                  $('.clientnotify').find('form')[0].reset();
                                  toastr.success(data.msg);
                              }
                        }
                    });
                });


    // Send Notify to Client


</script>
@endsection
