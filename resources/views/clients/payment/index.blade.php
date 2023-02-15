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



            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr class="p-3 mb-2 bg-dark text-white">
                            <th>#</th>


                            <th>المبلغ</th>
                            <th>العملة</th>
                            <th>البند المالي</th>
                            <th>التاريخ</th>
                            <th>الملاحظات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach($payment as $pay)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>




                                <td class="p-3 mb-2 bg-info text-white"> {{$pay->amount}} </td>
                                <td>{{$pay->currency}}</td>
                                <td>{{$pay->financial_item}}</td>
                                <td>{{$pay->date}}</td>
                                <td>{{$pay->note}}</td>

                            </tr>



                            @endforeach

                </table>
            </div>
        </div>
    </div>
</div>


<!-- add_modal_Grade -->



                        </div>

                    </div>



    </div>
</div>

</div>

<!-- row closed -->
@endsection
@section('js')






@endsection
