@extends('layouts.master')
@section('css')

@section('title')
    empty00
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> ncvlxcnvxcnvxcv</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Page Title</li>
            </ol>
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





            <div class="form-row">


            <div class="row g-3 align-items-center mb-2">

            <div class="col-auto">
            <form action="{{route('tracking.all')}}" method="GET">
              <label for="inputPassword6" class="col-form-label">{{__('track.search')}}</label>
            </div>
            <div class="col-auto">
              <input type="search"  name="search" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline">
            </div>
            <div class="col-auto">
              <span id="passwordHelpInline" class="form-text">
                Must be 8-20 characters long.
              </span>
              </form>
            </div>

          </div>




                          <div class="col-md-9">
                          <div  class="table-responsive">
                              <div class="card text-dark bg-light mb-3">
             <!--  -->
             @if(session('success'))
                              <div class="alert alert-success alert-dismissible fade show" role="alert">
                              <strong>{{session('success')}}</strong>
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                                @endif
            <!--  -->

                                  <div class="card-header bg-dark">
                                  <h6 class="display-6 text-light">{{__('track.All Tracking')}}</h6>


                                </div>




                      <table class="table-responsive  table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">{{__('track.Tracking Number')}}</th>
                <th scope="col">{{__('track.Code Number')}}</th>
                <th scope="col">{{__('track.Tracking Status')}}</th>
                <th scope="col">{{__('track.User')}}</th>
                <th scope="col">{{__('track.Created at')}}</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>


            @foreach($trackings as $track)
              <tr>
                <th scope="row">{{$trackings->firstItem()+$loop->index}}</th>
                <td >{{$track->tracking_number}}</td>
                <td>{{$track->code_number}}</td>

                <td class=" m-3 p-3"><span class="badge bg-success">
                {{$track->status->Status_Name}}</span></td>

                <td class="link-info">{{$track->user->name}}</td>
                <td>
                  @if($track->created_at == NULL)
                  <span class="text-danger"> No Date</span>
                   @else
                  {{Carbon\Carbon::parse($track->created_at)->diffForHumans()}}

                  @endif

                </td>
                <td>
                  <a href="{{url('tracking/edit/'.$track->id)}}" class="btn btn-info"><h6>{{__('track.edit')}}</h6></a>
                  <a href="{{url('SoftDelete/track/'.$track->id)}}" class="btn btn-success"><h6>{{__('track.complet')}}</h6></a>
                </td>
              </tr>


              @endforeach




            </tbody>
          </table>
          {{ $trackings->links() }}


          </div>




          </div>
</div>


                    <div class="col-md-3">
                    <div class="card">
                        <div class="card-header bg-dark text-light">{{__('track.Add Tracking')}}</div>
                        <div class="card-body">

                    <form action="{{route('store.tracking')}}" method="POST">
                      @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">{{__('track.Tracking Number')}}</label>
                        <input type="number" name="tracking_number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        @error('tracking_number')

                        <span class="text-danger"> {{$message}}</span>
                        @enderror


                        <label for="exampleInputEmail1" class="form-label">{{__('track.Code Number')}}</label>
                        <input type="number" name="code_number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        @error('code_number')

                        <span class="text-danger"> {{$message}}</span>
                        @enderror

                        <label for="exampleInputEmail1" class="form-label">{{__('track.Tracking Status')}}</label>
                        <select class="form-select"  name="tacking_status_id" aria-label="Default select example">
                        <option selected>...</option>
                            @foreach($Track_sta as $status)
                                <option value="{{$status->id}}">{{$status->Status_Name}}</option>
                            @endforeach
</select>

                    </div>

                    <button type="submit" class="btn btn-dark">{{__('track.Add Tracking')}}</button>
                    </form>
                    </div>

                        </div>
                         </div>



















                    </div>


  <div>


    <!--  noty -->

    <div class="dropdown ml-2" id="unreadNotifications" >
  <a class="btn btn-secondary dropdown-toggle" href="{{route('notification.all')}}" role="button" id="dropdownMenuLink" >
    <i class="bi bi-bell-fill"></i> <span  id="notifications_count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{count(Auth::user()->unreadNotifications)}}</span>
  </a>

  <ul class="dropdown-menu"  aria-labelledby="dropdownMenuLink">
      <div id="unreadNotifications">
      @foreach(Auth::user()->unreadNotifications as $noty)

    <li class="unread">

    {!! $noty->data['data'] !!}

</li>


    @endforeach
</div>

  </ul>

</div>






  <div>

  <label for="exampleInputEmail1" class="form-label">الدولة </label>
                        <select class="form-select"  name="tacking_status_id" aria-label="Default select example">
                        <option selected>...</option>
                            @foreach($Countrys as $Country)
                                <option value="{{$Country->id}}">{{$Country->Country_Name}}</option>
                            @endforeach
</select>


  </div>





  <!--  end noty -->




  <div>




  <div class="dropdown-menu dropdown-menu-right dropdown-big dropdown-notifications">
                        <div class="dropdown-header notifications">
                            <strong>Notifications</strong>
                            <span class="badge badge-pill badge-warning">05</span>
                        </div>
                        <div class="dropdown-divider"></div>






                        <a href="#" class="dropdown-item">New registered user <small
                                class="float-right text-muted time">Just now</small> </a>
                        <a href="#" class="dropdown-item">New invoice received <small
                                class="float-right text-muted time">22 mins</small> </a>
                        <a href="#" class="dropdown-item">Server error report<small
                                class="float-right text-muted time">7 hrs</small> </a>
                        <a href="#" class="dropdown-item">Database report<small class="float-right text-muted time">1
                                days</small> </a>
                        <a href="#" class="dropdown-item">Order confirmation<small class="float-right text-muted time">2
                                days</small> </a>
                    </div>


  </div>



  </div>






            <!-- -->

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
