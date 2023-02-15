@extends('layouts.master')
@section('css')
    
@section('title')
    {{ __('track.Archives') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ __('track.Archives') }}
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
              <h3>{{ __('track.Archives') }}</h3>


            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('track.Tracking Number') }}</th>
                            <th>{{ __('track.Code Number') }}</th>
                            <th>{{ __('track.Tracking Status') }}</th>
                            <th>{{ __('track.country') }}</th>
                            <th>{{ __('track.type tracking') }}</th>
                            <th>{{ __('track.User') }}</th>
                            <th>{{ __('track.Created at') }}</th>
                            <th>{{ __('track.Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach($trachtrack as $track)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{$track->tracking_number}}</td>
                                <td>{{$track->code_number}}</td>
                                <td>{{$track->status->Status_Name}}</td>
                                <td>{{$track->Country->Country_Name}}</td>
                                <td>{{$track->tracktype->tracking_type_name}}</td>
                                <td>{{$track->user->name}}</td>
                                <td>
                                @if($track->created_at == NULL)
                  <span class="text-danger"> No Date</span>
                   @else
                  {{Carbon\Carbon::parse($track->created_at)->toDateString()}}

                  @endif
                                </td>
                                <td>

                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $track->id }}"
                                        title="{{ __('track.delete tracking') }}"><i
                                            class="fa fa-trash"></i></button>
                                </td>
                            </tr>



                            <!-- delete_modal_Grade -->
                            <div class="modal fade" id="delete{{ $track->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ __('track.delete tracking') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('Delete', $track->id)}}" method="post">

                                                @csrf
                                                {{ __('track.Are you sure to delete') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{$track->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ __('track.Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-danger">{{ __('track.delete tracking') }}</button>
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




</div>

<!-- row closed -->
@endsection
@section('js')

@endsection
