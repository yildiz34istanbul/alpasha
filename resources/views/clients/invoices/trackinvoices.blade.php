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
                            <th>{{ __('track.file_name') }}</th>
                            <th>{{ __('track.Tracking Number') }} </th>
                            <th>{{ __('track.Created at') }}</th>
                            <th>{{ __('track.Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach($trackinvoices as $invoice)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>
                                @if(!empty($invoice->invoice))

                                {{$invoice->invoice}}
                                 @endif
                                </a>
                                </td>
                                <td>{{$invoice->tracking_id}}</td>
                                <td>
                                @if($invoice->created_at == NULL)
                  <span class="text-danger"> No Date</span>
                   @else
                  {{Carbon\Carbon::parse($invoice->created_at)->toDateString()}}

                  @endif
                                </td>
                                <td>



                                    @if(!str_contains($invoice->url, 'http'))
                                    <a class="btn btn-outline-info btn-sm" href="{{  asset('upload/invoices/'.$invoice->tracking_id.'/'.$invoice->invoice)}}" download="{{$invoice->invoice}}">
                                        <i class="fas fa-download"></i> عرض </a>
                                    @else
                                        <a class="btn btn-outline-info btn-sm" href="{{$invoice->url}}" target="_blank"  download="{{$invoice->url}}">
                                            <i class="fa fa-download"></i> عرض</a>
                                    @endif
                                </td>
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
