@extends('layouts.master')
@section('css')
  
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
                               @if(auth()->user()->is_admin==1)
            <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                {{ __('track.Add User') }}
            </button>
            @endif
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
                            <th>{{ __('track.User_type') }}</th>
                            <th>{{ __('track.Created at') }}</th>
                            <th>{{ __('track.Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach($users as $user)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->locale}}</td>
                                <td>
                                @if($user->is_admin == 1)
                                <span class="text-danger"> Admin</span>
                                @else
                                <span class="text-danger"> User</span>
                                @endif
                                </td>
                                <td>
                                @if($user->created_at == NULL)
                  <span class="text-danger"> No Date</span>
                   @else
                  {{Carbon\Carbon::parse($user->created_at)->diffForHumans()}}

                  @endif
                                </td>
                                <td>

                                 <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $user->id }}"
                                        title="{{ __('track.edit tracking') }}"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $user->id }}"
                                        title="{{ __('track.add to Archives') }}"><i
                                            class="fa fa-folder-open"></i></button>

                                </td>
                            </tr>
  <!--   edit user and delet       -->



                            <!-- edit_modal_user -->
                            <div class="modal fade" id="edit{{ $user->id }}" tabindex="-1" role="dialog"
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
                <form action="{{ route('Update.user', $user->id)}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="tracking_number" class="mr-sm-2">{{ __('track.Tracking Number') }}
                                </label>
                                <input id="id" type="hidden" name="id" class="form-control"
                                                            value="{{ $user->id }}">
                            <input id="name" type="text" name="name" class="form-control" value="{{ $user->name }}">

                        </div>
                        <div class="col">
                            <label for="password" class="mr-sm-2">password
                                </label>
                            <input type="password" class="form-control" name="password">
                        </div>

                    </div>
                    <div class="col">
                            <label for="email" class="mr-sm-2">Email
                                </label>
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}">

                        </div>

                        <div class="row">
                        <div class="col">
                            <label for="usertype" class="mr-sm-2">User Type
                                </label>
                                <select class="form-control"  name="is_admin" aria-label="Default select example">
                        <option selected>...</option>
                        <option value="1" @if (request('is_admin') == 'Admin') selected  @endif>Admin</option>

                                <option value="0">User</option>

</select>

                        </div>


                        <div class="col">
                            <label for="locale" class="mr-sm-2">locale
                                </label>
                                <select class="form-control"  name="locale" aria-label="Default select example">
                                <option selected>...</option>

                                <option value="ar">Ar</option>
                                <option value="tr">Tr</option>
                                <option value="en">En</option>

</select>


                        </div>

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
                            <div class="modal fade" id="delete{{ $user->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                delet user
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <form action="{{ route('Delete.user', $user->id)}}" method="post">

                                                @csrf
                                                {{ __('track.Are you sure to add to the archive') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{$user->id }}">
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



 <!--   edit user and delet       -->


                            @endforeach

                </table>
            </div>
        </div>
    </div>
</div>


<!-- add_modal_user -->
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



                <form action="{{route('store.user')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="name" class="mr-sm-2">UserName
                                </label>
                            <input id="name" type="text" name="name" class="form-control">
                        </div>
                        <div class="col">
                            <label for="password" class="mr-sm-2">password
                                </label>
                            <input type="password" class="form-control" name="password">
                        </div>

                    </div>
                    <div class="col">
                            <label for="email" class="mr-sm-2">Email
                                </label>
                                <input type="email" class="form-control" name="email">

                        </div>

                        <div class="row">
                        <div class="col">
                            <label for="usertype" class="mr-sm-2">User Type
                                </label>
                                <select class="form-control"  name="is_admin" aria-label="Default select example">
                        <option selected>...</option>
                        <option value="1" @if (request('is_admin') == 'Admin') selected  @endif>Admin</option>

                                <option value="0">User</option>

</select>

                        </div>
                        <div class="col">
                            <label for="locale" class="mr-sm-2">locale
                                </label>
                                <select class="form-control"  name="locale" aria-label="Default select example">
                                <option selected>...</option>

                                <option value="ar">Ar</option>
                                <option value="tr">Tr</option>
                                <option value="en">En</option>

</select>


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

</div>

<!-- row closed -->
@endsection
@section('js')

@endsection
