@extends('layouts.master')
@section('css')

    
@section('title')
    {{ __('track.All Tracking') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ __('track.All Tracking') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">


@if ($errors->any())
    <div class="error">{{ $errors->first('Name') }}</div>
    <div class="error">{{ $errors->first() }}</div>
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


            <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                {{ __('track.Add Tracking Number') }}
            </button>

            <button type="button" class="button x-small" id="btn_delete_all"  >
                    تعديل جميع الشحنات المختارة
                </button>
             <!--   <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#import"
                                        title="رفع ملف اكسل "><i class="fa fa-upload"></i></button>
-->
                                        <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr class="p-3 mb-2 bg-dark text-white">
                        <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
                            <th>#</th>
                            <th>{{ __('track.Tracking Number') }}</th>
                            <th>{{ __('track.Code Number') }}</th>
                            <th>{{ __('track.Tracking Status') }}</th>
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
                        <?php $i = 0; ?>
                        @foreach($trackings as $track)
                            <tr>
                                <?php $i++; ?>
                                <td><input type="checkbox"  value="{{ $track->id }}" class="box1" ></td>
                                <td>{{ $i }}</td>
                                <td>{{$track->tracking_number}}</td>
                                <td>{{$track->code_number}}</td>
                               <td style="padding-right: 5px;padding-left: 5px;" >
                                @if($track->tacking_status_id == 1)
                                   <span  style="padding: 5px;background-color:#FF5722;color:#fff;"> {{$track->status->Status_Name}} </span>
                                @elseif($track->tacking_status_id == 2)
                                <span  style="padding: 5px;background-color:#607D8B;color:#fff;"> {{$track->status->Status_Name}} </span>
                                @elseif($track->tacking_status_id == 3)
                                <span  style="padding: 5px;background-color:#795548;color:#fff;"> {{$track->status->Status_Name}} </span>
                                @elseif($track->tacking_status_id == 4)
                                <span  style="padding: 5px;background-color:#E91E63;color:#fff;"> {{$track->status->Status_Name}} </span>
                                @elseif($track->tacking_status_id == 5)
                                <span  style="padding: 5px;background-color:#3F51B5;color:#fff;"> {{$track->status->Status_Name}} </span>
                                @elseif($track->tacking_status_id == 6)
                                <span  style="padding: 5px;background-color:#9C27B0;color:#fff;"> {{$track->status->Status_Name}} </span>
                                @elseif($track->tacking_status_id == 7)
                                <span style="padding: 5px;background-color:#F44336;color:#fff;"> {{$track->status->Status_Name}} </span>
                                @elseif($track->tacking_status_id == 8)
                                <span style="padding: 5px;background-color:#4CAF50;color:#fff;"> {{$track->status->Status_Name}} </span>

                                @endif
                                </td>

                                <td>{{$track->trackmethod->method_name}}</td>
                                <td>{{$track->Country->Country_Name}}</td>
                                <td>{{$track->tracktype->tracking_type_name}}</td>
                                <td>{{$track->cartons_number}}</td>
                                <td>{{$track->pieces_number}}</td>
                                <td >{{$track->weight}} KG</td>
                                <td> <span>$</span>{{$track->invoice_value}}</td>
                                <td>
                                @if($track->arrival_time == NULL)
                  <span class="text-danger"> لا معلومات</span>
                   @else
                  {{Carbon\Carbon::parse($track->arrival_time)->toDateString()}}

                  @endif
                                </td>
                               <td >{{$track->notes}}</td>
                             
                                <td>
                                @if($track->created_at == NULL)
                  <span class="text-danger"> No Date</span>
                   @else
                  {{Carbon\Carbon::parse($track->created_at)->toDateString()}}

                  @endif
                                </td>
                                <td>
                                <div class="dropdown show">
                                                        <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            العمليات
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                                                            <a class="dropdown-item" data-target="#edit{{ $track->id }}" data-toggle="modal" href="#edit{{ $track->id }}"><i style="color: #0000cc" class="fa fa-edit"></i>&nbsp; {{ __('track.edit tracking') }}</a>
                                                            <a class="dropdown-item" data-target="#updatvalue{{ $track->id }}" data-toggle="modal" href="#updatvalue{{ $track->id }}"><i style="color: #0000cc" class="fa  fa-clipboard"></i>&nbsp; تعديل تفاصيل الشحنة</a>
                                                            <a class="dropdown-item" data-target="#addvalue{{ $track->id }}" data-toggle="modal" href="#addvalue{{ $track->id }}"><i style="color: #0000cc" class="fa fa-dollar"></i>&nbsp; اضافة قيمة الشحنة  </a>
                                                            <a class="dropdown-item"  href="{{route('add.invoices',$track->id)}}"><i style="color: #0000cc" class="fa fa-file-image-o"></i>&nbsp; اضافة صور الفواتير </a>
                                                            <a class="dropdown-item" data-target="#delete{{ $track->id }}" data-toggle="modal" href="#delete{{ $track->id }}"><i style="color: red" class="fa fa-folder-open"></i>&nbsp;  {{ __('track.add to Archives') }}</a>
                                                        </div>
                                                    </div>


                                </td>
                            </tr>

                <!-- edit_modal_ -->
                <div class="modal fade" id="edit{{ $track->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                    id="exampleModalLabel">
                                    {{ __('track.edit tracking') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- add_form -->
    <form action="{{ route('Update', $track->id)}}" method="POST">
        @csrf
        <div class="row">
            <div class="col">
                <label for="tracking_number" class="mr-sm-2">{{ __('track.Tracking Number') }}
                    </label>
                    <input id="id" type="hidden" name="id" class="form-control"
                                                value="{{ $track->id }}">

                <input id="tracking_number" type="number" name="tracking_number1" class="form-control" value="{{ $track->tracking_number }}"disabled >
                <input id="id" type="hidden" name="tracking_number" class="form-control"
                                                value="{{ $track->tracking_number }}">
            </div>
            <div class="col">
                <label for="code_number" class="mr-sm-2">{{ __('track.Code Number') }}
                    </label>
                <input type="number" class="form-control" name="code_number1" value="{{ $track->code_number }}" disabled>
                <input id="id" type="hidden" name="code_number" class="form-control"
                                                value="{{ $track->code_number }}">
            </div>

        </div>
        <div class="col">
                <label for="tacking_status_id" class="mr-sm-2">{{ __('track.Tracking Status') }}
                    </label>
                    <select id ="selstatus" class="form-control selstatus"  name="tacking_status_id" aria-label="Default select example" value="{{ $track->status->Status_Name }}">
                    <option value="{{$track->status->id }}">{{$track->status->Status_Name}}</option>
                @foreach($Track_sta as $status)
                    <option value="{{$status->id}}">{{$status->Status_Name}}</option>





                @endforeach
</select>

</div>

<div class="col">
                <label for="tacking_status_id" class="mr-sm-2">طريقة الشحن
                    </label>


                    <select id ="selstatus" class="form-control selstatus"  name="track_method_id" aria-label="Default select example" value="">
                    <option value="{{$track->trackmethod->id}}">{{$track->trackmethod->method_name}}</option>
                            @foreach($TrackMethod as $method)
                                <option value="{{$method->id}}">{{$method->method_name}}</option>
                            @endforeach
</select>

</div>


<div class="row">






</div>





            <div  id="test44" class="col" style = "display: none;" >
                <label for="" class="mr-sm-2">{{ __('track.Code Number') }}
                    </label>
                <input type="text" class="form-control" name="" value="">
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





                               <!-- add value tracking-->





                          <!-- edit_modal_Grade -->
                <div class="modal fade" id="addvalue{{ $track->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                    id="exampleModalLabel">
                                    اضافة قيمة الشحنة
                                </h5>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- add_form -->
    <form action="{{ route('add.value', $track->id)}}" method="POST">
        @csrf
        <div class="row">
            <div class="col">

                    <input id="id" type="hidden" name="id" class="form-control"
                                                value="{{ $track->id }}">
             <input id="id" type="hidden" name="code_number" class="form-control"
                                                value="{{ $track->code_number }}">

            </div>
            <div class="col">

            </div>

        </div>
        <div class="col">



<div class="row">







            <div class="col">
            <label for="invoice_value" class="mr-sm-2">قيمة الشحنة  $
                    </label>
                    @if($track->invoice_value==null)
                <input type="decimal" required class="form-control" name="invoice_value" value="">
                  @else
                  <input type="decimal" required class="form-control" name="invoice_value" value="{{ $track->invoice_value }}" >
                  @endif
                    <input id="id" type="hidden" name="id" class="form-control"
                                                value="{{ $track->id }}">


            </div>



</div>





            <div  id="test44" class="col" style = "display: none;" >
                <label for="" class="mr-sm-2">{{ __('track.Code Number') }}
                    </label>
                <input type="text" class="form-control" name="" value="">
            </div>




        <div class="form-group">

        </div>
        <br><br>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary"
        data-dismiss="modal">{{ __('track.Close') }}</button>
        @if($track->invoice_value==null)
    <button type="submit" class="btn btn-success">{{ __('track.edit') }}</button>
    @else
    <button type="submit" class="btn btn-success" >{{ __('track.edit') }}</button>
    @endif
</div>
</form>

                            </div>
                        </div>
                    </div>
                </div>



<!-- updat value tracking - pieces  -->










                          <!-- edit_value tracking _ pieces -->
                          <div class="modal fade" id="updatvalue{{ $track->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
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
                                <!-- add_form -->
    <form action="{{ route('Updat.ValuePieces', $track->id)}}" method="POST">
        @csrf
        <div class="row">
            <div class="col">

                    <input id="id" type="hidden" name="id" class="form-control"
                                                value="{{ $track->id }}">
             <input id="id" type="hidden" name="code_number" class="form-control"
                                                value="{{ $track->code_number }}">

            </div>
            <div class="col">

            </div>

        </div>
        <div class="col">



<div class="row">



<div class="col">
                <label for="cartons_number" class="mr-sm-2">عدد الكراتين
                    </label>

                <input id="cartons_number" type="number" name="cartons_number" class="form-control" value="{{ $track->cartons_number }}">

            </div>
            <div class="col">
            <label for="arrival_time" class="mr-sm-2">تخمين الوصول
                    </label>
                    <input id="id" type="hidden" name="id" class="form-control"
                                                value="{{ $track->id }}">
                <input id="arrival_time" type="date" name="arrival_time" class="form-control" value="{{ \Carbon\Carbon::parse($track->arrival_time)->format('Y-m-d') }}">
            </div>
            </div>



            <div class="col">
            <label for="arrival_time" class="mr-sm-2">عدد القطع
                    </label>
                    <input id="id" type="hidden" name="id" class="form-control"
                                                value="{{ $track->id }}">



                <input id="pieces_number" type="number" name="pieces_number" class="form-control" value="{{ $track->pieces_number }}">


            </div>


 <div class="col">
            <label for="arrival_time" class="mr-sm-2">الوزن
                    </label>
                    <input id="id" type="hidden" name="id" class="form-control"
                                                value="{{ $track->id }}">



                <input id="pieces_number" type="text" name="weight" class="form-control" value="{{ $track->weight }}">


            </div>
            <div class="col">
            <label for="arrival_time" class="mr-sm-2">الملاحظات
                    </label>
                    <input id="id" type="hidden" name="id" class="form-control"
                                                value="{{ $track->id }}">



                <input id="pieces_number" type="text" name="notes" class="form-control" value="{{ $track->notes }}">


            </div>





</div>





            <div  id="test44" class="col" style = "display: none;" >
                <label for="" class="mr-sm-2">{{ __('track.Code Number') }}
                    </label>
                <input type="text" class="form-control" name="" value="">
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
















                            <!-- delete_modal_Grade -->
                            <div class="modal fade" id="delete{{ $track->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ __('track.add to Archives') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('SoftDelete', $track->id)}}" method="post">

                                                @csrf
                                                {{ __('track.Are you sure to add to the archive') }}
                                                <br>

                                                @if($track->tacking_status_id !== 7)
                                                <h6 class="mt-0 text-danger">الشحنة التالية لم يتم تأكيد التسليم هل انت متأكد من ارسالها الى الارشيف</h6>

                                                  @endif
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{$track->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ __('track.Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-danger">{{ __('track.add to Archives') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach

                </table>
		 
            </div>
        </div>
    </div>
</div>


<!-- add_modal_tracking -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form action="{{route('store.tracking')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="tracking_number" class="mr-sm-2">{{ __('track.Tracking Number') }}
                                </label>
                            <input id="tracking_number" type="number" name="tracking_number" class="form-control">
                        </div>
                        <div class="col">
                            <label for="code_number" class="mr-sm-2">{{ __('track.Code Number') }}
                                </label>
                            <input type="number" class="form-control" name="code_number">
                        </div>

                    </div>
                    <div class="col">
                            <label for="tacking_status_id" class="mr-sm-2">{{ __('track.Tracking Status') }}
                                </label>
                                <select class="form-control"  name="tacking_status_id" aria-label="Default select example">
                        <option selected>...</option>
                            @foreach($Track_sta as $status)
                                <option value="{{$status->id}}">{{$status->Status_Name}}</option>
                            @endforeach
</select>
                        </div>
                        <div class="col">
                            <label for="track_method_id" class="mr-sm-2">طريقة الشحن
                                </label>
                                <select class="form-control"  name="track_method_id" aria-label="Default select example">
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
                                <select class="form-control"  name="country_id" aria-label="Default select example">
                        <option selected>...</option>
                        @foreach($Countrys as $Country)
                                <option value="{{$Country->id}}">{{$Country->Country_Name}}</option>
                            @endforeach
</select>

                        </div>
                        <div class="col">
                            <label for="type_tracking_id" class="mr-sm-2">{{ __('track.type tracking') }}
                                </label>
                                <select class="form-control"  name="type_tracking_id" aria-label="Default select example">
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
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{ __('track.Close') }}</button>
                <button type="submit" class="btn btn-success">{{ __('track.submit') }}</button>
            </div>
            </form>

        </div>













    </div>





















</div>




                             <!-- add excle file  -->
                             <div class="modal fade" id="import" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                               اضافة شحنات جديدة
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                        <form action="{{ route('Track.import')}}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="row">
                        <div class="col">

                                <input id="id" type="hidden" name="id" class="form-control"
                                                            value="">
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



  <!--  end add excle file  -->





   <!-- update all -->
   <div class="modal fade" id="update_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                {{ __('track.Tracking Status') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('update.all')}}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    تعديل حالة الشحنات المختارة
                    <input class="text" type="true" id="update_all_id" name="update_all_id" >
                </div>

                <div class="col">
                            <label for="tacking_status_id" class="mr-sm-2">{{ __('track.Tracking Status') }}
                                </label>
                                <select class="form-control"  name="tacking_status_id" aria-label="Default select example">
                        <option selected>...</option>
                            @foreach($Track_sta as $status)
                                <option value="{{$status->id}}">{{$status->Status_Name}}</option>
                            @endforeach
</select>
                        </div>
                        <br><br>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('track.Close') }}</button>
                    <button type="submit" class="btn btn-danger">{{ __('track.edit') }}</button>
                </div>
            </form>
        </div>
    </div>

</div>

</div>

<!-- row closed -->
@endsection
@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>













<script type="text/javascript">
    $(function() {
        $("#btn_delete_all").click(function() {
            var selected = new Array();
            $("#datatable input[type=checkbox]:checked").each(function() {
                selected.push(this.value);
            });
            if (selected.length > 0) {
                $('#update_all').modal('show')
                $('input[id="update_all_id"]').val(selected);
            }
        });
    });
</script>

<script type="text/javascript">





</script>




@endsection
