@extends('layouts.master')
@section('css')

@section('title')
{{ __('track.Reports') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('track.Reports') }}</h4>
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
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">


            <form method="post"  action="{{ route('Search_tracking') }}" autocomplete="off">
                    @csrf
                    <h6 style="font-family: 'Cairo', sans-serif;">{{ __('track.Search information') }}</h6><br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="Tracking Status">{{ __('track.Tracking Status') }}</label>
                                <select class="custom-select mr-sm-2" name="type">

                                @foreach($Track_status as $Trackstatus)
                                        <option value="{{$Trackstatus->id}}">{{$Trackstatus->Status_Name}}</option>
                                    @endforeach



                                </select>
                            </div>
                        </div>

                        <div class="card-body datepicker-form">
                            <div class="input-group" data-date-format="yyyy-mm-dd">
                                <input type="text"  class="form-control range-from date-picker-default" placeholder="{{ __('track.Start Date') }}"  name="from">
                                <span class="input-group-addon">{{ __('track.To Date') }}</span>
                                <input class="form-control range-to date-picker-default" placeholder="{{ __('track.End Date') }}" type="text"  name="to">
                            </div>
                        </div>

                    </div>
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{ __('track.search') }}</button>
                </form>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (isset($details))
                    <table id="example" class="table key-buttons text-md-nowrap" style=" text-align: center">
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
                            <th>{{ __('track.updated at') }}</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($details as $track)
                                <?php $i++; ?>
                                <tr>
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
                                @if($track->updated_at == NULL)
                  <span class="text-danger"> No Date</span>
                   @else
                  {{Carbon\Carbon::parse($track->updated_at)->toDateString()}}

                  @endif
                                </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endisset

            </div>















            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

<script>
    var date = $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    }).val();
</script>

<script>
    $(document).ready(function() {
        $('#invoice_number').hide();
        $('input[type="radio"]').click(function() {
            if ($(this).attr('id') == 'type_div') {
                $('#invoice_number').hide();
                $('#type').show();
                $('#start_at').show();
                $('#end_at').show();
            } else {
                $('#invoice_number').show();
                $('#type').hide();
                $('#start_at').hide();
                $('#end_at').hide();
            }
        });
    });
</script>


@endsection
