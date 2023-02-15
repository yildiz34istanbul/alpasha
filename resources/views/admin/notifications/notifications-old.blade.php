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
            <h4 class="mb-0"> noty</h4>
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
                    <div class="form-group col-md-6">
                        <p>{{trans('track.Edit Tracking')}}</p>




                        <div class="col-md-12">
                    <div class="card">




                        <div class="card-header bg-dark">
                        <h6 class="display-6 text-light">الاشعارات الجديدة </h6>


                      </div>




            <table class="table-responsive  table table-striped">
  <thead>
    <tr>

      <th scope="col">الاشعارات </th>

    </tr>
  </thead>
  <tbody>

  <?php    ?>
  @foreach(Auth::user()->unreadNotifications()->paginate(10) as $noty)
    <tr>


      <td  class="link-info"> {!! $noty->data['data'] !!} </td>

    </tr>


    @endforeach




  </tbody>
</table>
{{ Auth::user()->unreadNotifications()->paginate(10)->links() }}
<div>
  <a href="{{route('MarkAsRead_all')}}" class="btn btn-info"><h6>تعين قراءة الكل</h6></a>

  </div>

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
