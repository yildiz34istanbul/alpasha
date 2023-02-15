@extends('layouts.master')
@section('css')
   
@section('title')
            اضافة مرفقات الفواتير
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    اضافة فاتورة
@stop
<!-- breadcrumb -->
@endsection
@section('content')







  <!-- row -->
  <div class="row">
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

                <div class="row">
 <div class="col-md-6 mb-1">

<label for="inputEmail3" class="col-sm-2 col-form-label"> الشحنة رقم</label>
<h3> {{$tracking->tracking_number}}</h3>

</div>

<div class="col-md-6 mb-1">

<label for="inputEmail3" class="col-sm-2 col-form-label"> كود الزبون </label>
<h3> {{$tracking->code_number}}</h3>

</div>
</div>



                          <div class="card card-statistics">
                                        <div class="card-body">
                                            <form method="post" action="{{route('store.invoices',$tracking->id)}}" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label
                                                            for="academic_year">اضافة رابط الصورة
                                                            : <span class="text-danger">*</span></label>
                                                        <input type="text" name="invoice" class="form-control" placeholder="الرابط" required>
                                                        <input type="text" name="name" class="form-control mt-1" required placeholder="اسم الملف">
                                                        <input type="hidden" name="tracking_id" value="{{$tracking->id}}">
                                                        <input type="hidden" name="tracking_number" value="{{$tracking->tracking_number}}">

                                                    </div>
                                                </div>
                                                <br><br>
                                                <button type="submit" class="button button-border x-small">
                                                      ارسال
                                                </button>
                                            </form>
                                        </div>
                                        <br>
                                        <div class="table-responsive ">
                                        <table id="datatable" class="table  table-hover table-sm table-bordered " data-page-length="5"
                    style="text-align: center">
                                            <thead>

                                            <tr class="table-secondary">
                                                <th scope="col">#</th>
                                                <th scope="col">الفواتير </th>

                                                <th scope="col">العمليات </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i = 0; ?>
                                            @foreach($ClientInvoices as $ClientInvoice)
                                                <tr style='text-align:center;vertical-align:middle'>
                                                <?php $i++; ?>
                                                    <td>{{ $i }}</td>
                                                    <td>{{$ClientInvoice->invoice}}</td>

                                                  <td colspan="2">
                                                        @if(!str_contains($ClientInvoice->url, 'http'))
                                                    <a class="btn btn-outline-info btn-sm" href="{{  asset('upload/invoices/'.$ClientInvoice->tracking_id.'/'.$ClientInvoice->invoice)}}" download="{{$ClientInvoice->invoice}}">
                                                           <i class="fa fa-download"></i> عرض</a>
                                                        @else
                                                            <a class="btn btn-outline-info btn-sm" href="{{$ClientInvoice->url}}" target="_blank">
                                                                <i class="fa fa-download"></i> عرض</a>
                                                            @endif
                                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#Delete_img{{ $ClientInvoice->id }}"
                                                                title="حذف">حذف
                                                        </button>

                                                    </td>
                                                </tr>









   <!-- Deleted invoice -->
<div class="modal fade" id="Delete_img{{$ClientInvoice->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel"> حذف المرفق   </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('Delete_Invoices')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$ClientInvoice->id}}">

                    <input type="hidden" name="invoice" value="{{$ClientInvoice->invoice}}">
                    <input type="hidden" name="Invoice_id" value="{{$ClientInvoice->id}}">
                    <input type="hidden" name="tracking_id" value="{{$ClientInvoice->tracking_id}}">

                    <h5 style="font-family: 'Cairo', sans-serif;">هل أنت متأكد من حذف المرفق </h5>
                    <input type="text" name="filename" readonly value="{{$ClientInvoice->invoice}}" class="form-control">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        <button  class="btn btn-danger">حذف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





                                                @endforeach
                                            </tbody>
                                        </table>
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
