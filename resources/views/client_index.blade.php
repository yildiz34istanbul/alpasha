@extends('layouts.master')
@section('css')
    @toastr_css
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
                        <tr>
                            <th>#</th>
                            <th>{{ __('track.user_name') }}</th>
                            <th>{{ __('track.email') }}</th>
                            <th>{{ __('track.notification_language') }}</th>
                            <th>{{ __('track.Created at') }}</th>
                            <th>{{ __('track.Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach($clients as $client)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{$client->name}}</td>
                                <td>{{$client->email}}</td>
                                <td>{{$client->locale}}</td>

                                <td> {{Carbon\Carbon::parse($client->created_at)->toDateString()}}</td>

                                <td>
                                <div class="dropdown show">
                                                        <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            العمليات
                                                        </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" href=""><i style="color: #ffc107" class="far fa-eye "></i>&nbsp;  عرض بيانات الطالب</a>
                                                            <a class="dropdown-item" href=""><i style="color:green" class="fa fa-edit"></i>&nbsp;  تعديل بيانات الطالب</a>
                                                            <a class="dropdown-item" href=""><i style="color: #0000cc" class="fa fa-edit"></i>&nbsp;اضافة فاتورة رسوم&nbsp;</a>
                                                            <a class="dropdown-item" href=""><i style="color: #9dc8e2" class="fas fa-money-bill-alt"></i>&nbsp; &nbsp;سند قبض</a>
                                                            <a class="dropdown-item" href=""><i style="color: #9dc8e2" class="fas fa-money-bill-alt"></i>&nbsp; &nbsp; استبعاد رسوم</a>
                                                            <a class="dropdown-item" href=""><i style="color:goldenrod" class="fas fa-donate"></i>&nbsp; &nbsp;سند صرف</a>
                                                            <a class="dropdown-item" data-target="#Delete_Student" data-toggle="modal" href="##Delete_Student"><i style="color: red" class="fa fa-trash"></i>&nbsp;  حذف بيانات الطالب</a>
                                                        </div>
                                                        </div>
                                </td>
                            </tr>
  <!--   edit user and delet       -->






                            @endforeach

                </table>
            </div>
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
@toastr_js
@toastr_render
@endsection
