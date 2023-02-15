@extends('layouts.master')
@section('css')

@section('title')
  {{ __('track.Countries') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">  {{ __('track.Countries') }}</h4>
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
                                @if(session('error'))
                              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              <strong>{{session('error')}}</strong>
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                                @endif
                                @if(Auth::user()->is_admin == 1)
                                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                {{ __('track.Add Countries') }}
            </button>
            @endif
            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('track.Country name') }}</th>
                            @if(auth()->user()->is_admin == 1)
                            <th>{{ __('track.Action') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach($Countrys as $Country)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{$Country->Country_Name}}</td>
                                @if(Auth::user()->is_admin == 1)
                                <td>

                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $Country->id }}"
                                        title="{{ __('track.delete country') }}"><i
                                            class="fa fa-trash"></i></button>
                                </td>
                                @endif
                            </tr>

                                                          <!-- delete_modal_country -->
                            <div class="modal fade" id="delete{{ $Country->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ __('track.delete country') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('Delete.country', $Country->id)}}" method="post">

                                                @csrf
                                                {{ __('track.Are you sure to delete country') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{$Country->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ __('track.Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-danger">{{ __('track.delete country') }}</button>
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

<!-- add_modal_Grade -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                {{ __('track.Add Countries') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{route('store.country')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="Name_en" class="mr-sm-2">{{ __('track.country name EN') }}
                                </label>
                            <input id="Name_en" type="text" name="Name_en" class="form-control" required>
                        </div>
                        <div class="col">
                            <label for="Name_ar" class="mr-sm-2">{{ __('track.country name AR') }}
                                </label>
                            <input type="text" class="form-control" name="Name_ar" required>
                        </div>

                    </div>
                    <div class="col">
                            <label for="Name_tr" class="mr-sm-2">{{ __('track.country name TR') }}
                                </label>
                                <input type="text" class="form-control" name="Name_tr" required>

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

</div>

<!-- row closed -->
@endsection
@section('js')

@endsection
