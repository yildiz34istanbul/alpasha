@extends('layouts.master')
@section('css')
 
@section('title')
    العملاء
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    العملاء
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

                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                     {{ __('track.Add_a_new_customer') }}
                    </button>

                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr class="p-3 mb-2 bg-dark text-white">
                                <th>#</th>
                                <th>#</th>
                                <th>{{ __('track.user_name') }}</th>
                                <th>{{ __('track.email') }}</th>
                                <th>{{ __('track.Mobile_number') }}</th>
                                <th>{{ __('track.Code Number_client') }}</th>
                                <th>{{ __('track.country') }}</th>
                                <th>{{ __('track.Account_Status') }}</th>
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


                                    <td><img class="img-fluid avatar-small"
                                             src="{{ (!empty($client->profile_photo_path))? url('upload/client_images/'.$client->profile_photo_path):url('upload/no-image.png') }}"
                                             alt=""></td>

                                    <td> {{$client->name}} </td>
                                    <td>{{$client->email}}</td>
                                    <td>{{$client->phone}}</td>
                                    <td>
                                    <span class="p-2 mb-1 bg-info text-white">
                                    {{$client->code_number}}
                                   </span>
                                    </td>
                                    <td>{{$client->country}}</td>
                                    <td>


                                        @if($client->status == 1)
                                            <span class=" badge badge-success">{{ __('track.Enabled') }} </span>
                                        @else
                                            <span class="badge badge-danger"> {{ __('track.Not_enabled') }} </span>
                                        @endif
                                    </td>


                                    <td> {{Carbon\Carbon::parse($client->created_at)->toDateString()}}</td>
                                    <td>

                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#active{{ $client->id }}"
                                                title="تفعيل الحساب"><i class="fa fa-check"></i></button>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#notify{{ $client->id }}"
                                                title="ارسال اشعار"><i class="fa fa-send"></i></button>

                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $client->id }}"
                                                title="تعديل البيانات"><i class="fa fa-edit"></i></button>


                                        <button style="background-color: #ffc135;" type="button"
                                                class="btn btn-info btn-sm"

                                                title="عرض البيانات"><a href="{{route('client.view',$client->id)}}"><i
                                                        style="color: #ffffff;" class="fa fa-eye"></i></a></button>


                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $client->id }}"
                                                title="حذف"><i
                                                    class="fa fa-trash"></i></button>

                                    </td>
                                </tr>
                                <!--   edit user and delet       -->



                                <!-- edit_modal_client -->
                                <div class="modal fade" id="edit{{ $client->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ __('track.edit_client') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- add_form -->
                                                <form action="{{ route('Client.Update', $client->id)}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="tracking_number"
                                                                   class="mr-sm-2">{{ __('track.user_name') }}
                                                            </label>
                                                            <input id="id" type="hidden" name="id" class="form-control"
                                                                   value="{{ $client->id }}">
                                                            <input id="name" type="text" name="name"
                                                                   class="form-control" value="{{ $client->name }}">

                                                        </div>
                                                        <div class="col">
                                                            <label for="password"
                                                                   class="mr-sm-2">{{ __('track.password') }}
                                                            </label>
                                                            <input type="password" class="form-control" name="password">
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="email" class="mr-sm-2">{{ __('track.email') }}
                                                            </label>
                                                            <input type="email" class="form-control" name="email"
                                                                   value="{{ $client->email }}">

                                                        </div>
                                                        <div class="col">
                                                            <label for="email"
                                                                   class="mr-sm-2">{{ __('track.Code Number_client') }}
                                                            </label>
                                                            <input type="number" class="form-control" name="code_number"
                                                                   value="{{ $client->code_number }}">

                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="usertype" class="mr-sm-2">{{ __('track.Mobile_number') }}
                                                            </label>
                                                            <input type="number" class="form-control" name="phone"
                                                                   value="{{ $client->phone }}">


                                                        </div>


                                                        <div class="col">
                                                            <label for="locale"
                                                                   class="mr-sm-2">{{ __('track.notification_language') }}
                                                            </label>
                                                            <select class="form-control" name="locale"
                                                                    aria-label="Default select example">

                                                                 <option value="{{ $client->locale}}">{{ $client->locale}}</option>
                                                                <option value="ar">Ar</option>
                                                                <option value="tr">Tr</option>
                                                                <option value="en">En</option>

                                                            </select>


                                                        </div>

                                                    </div>
													
													
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="usertype" class="mr-sm-2">{{ __('track.country') }}
                                                            </label>
                                                            <input type="text" class="form-control" name="country"
                                                                   value="{{ $client->country}}">


                                                        </div>
                                                        <div class="col">
                                                            <label for="usertype" class="mr-sm-2">{{ __('track.City') }}
                                                            </label>
                                                            <input type="text" class="form-control" name="city"
                                                                   value="{{ $client->city}}">


                                                        </div>


                                                      
                                                    </div>

                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="usertype" class="mr-sm-2">{{ __('track.address') }}
                                                            </label>
                                                            <input type="text" class="form-control" name="address"
                                                                   value="{{ $client->address}}">

                                                        </div>

                                                    </div>

													
													
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="usertype" class="mr-sm-2">{{ __('track.ID_photo') }}
                                                            </label>
                                                            <input type="file" class="form-control" name="id_photo"
                                                                   value="">

                                                        </div>

                                                    </div>


                                                    <div class="form-group">

                                                    </div>
                                                    <br><br>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ __('track.Close') }}</button>
                                                <button type="submit"
                                                        class="btn btn-success">{{ __('track.edit') }}</button>
                                            </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                    </div>

                    <!-- delete_modal_Grade -->
                    <div class="modal fade" id="delete{{ $client->id }}" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                        id="exampleModalLabel">
                                        {{ __('track.delete') }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form action="{{ route('Delete.Client', $client->id)}}" method="post">

                                        @csrf
                                        {{ __('track.Are you sure you want to delete the user') }}
                                        <input id="id" type="hidden" name="id" class="form-control"
                                               value="{{$client->id }}">
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{ __('track.Close') }}</button>
                                            <button type="submit"
                                                    class="btn btn-danger">{{ __('track.delete') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- active_modal_client -->
                    <div class="modal fade" id="active{{ $client->id }}" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                        id="exampleModalLabel">
                                      {{ __('track.activate_the_account') }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form action="{{ route('Client.active', $client->id)}}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col">
                                                <label for="tracking_number" class="mr-sm-2"> {{ __('track.Activate_disable_customers_account') }}
                                                    <span class=" p-1 mb-2 bg-info text-white"> {{$client->name}} </span>
                                                </label>
                                                <br>
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                       value="{{ $client->id }}">
                                                <select class="form-control" name="status"
                                                        aria-label="Default select example">
                                                    <option selected>...</option>

                                                    <option value="1">{{ __('track.Enabled') }}</option>
                                                    <option value="0">{{ __('track.Not_enabled') }}</option>


                                                </select>

                                            </div>

                                        </div>


                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{ __('track.Close') }}</button>
                                            <button type="submit"
                                                    class="btn btn-success">{{ __('track.edit') }}</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="notify{{ $client->id }}" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                        id="exampleModalLabel">
                                      {{ __('track.send_notice') }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form action="{{ route('Client.notify', $client->id)}}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col">
                                                <label for="tracking_number" class="mr-sm-2"> {{ __('track.send_notice') }}
                                                    <span class=" p-1 mb-2 bg-info text-white"> {{$client->name}} </span>
                                                </label>
                                                <br>
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                       value="{{ $client->id }}">

                                                <input id="text" type="text" name="text" class="form-control"
                                                       value="">


                                            </div>

                                        </div>


                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{ __('track.Close') }}</button>
                                            <button type="submit"
                                                    class="btn btn-success">{{ __('track.submit') }}</button>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="Addclient"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="Addclient">
                     {{ __('track.Add_a_new_customer') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- add_form -->


                    <form action="{{ route('add.clients') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="name" class="mr-sm-2"> {{ __('track.user_name') }}
                                </label>
                                <input id="name" type="text" name="name" class="form-control">
                            </div>
                            <div class="col">
                                <label for="password" class="mr-sm-2"> {{ __('track.password') }}
                                </label>
                                <input type="password" class="form-control" name="password">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="email" class="mr-sm-2">{{ __('track.email') }}
                                </label>
                                <input type="email" class="form-control" name="email">


                            </div>
                            <div class="col">

                                <label for="code_number" class="mr-sm-2">{{ __('track.Code Number') }}
                                </label>
                                <input type="number" class="form-control" name="code_number">

                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="phone" class="mr-sm-2">{{ __('track.Mobile_number') }}
                                </label>
                                <input type="number" class="form-control" name="phone">

                            </div>
                            <div class="col">
                                <label for="locale" class="mr-sm-2">{{ __('track.notification_language') }}
                                </label>
                                <select class="form-control" name="locale" aria-label="Default select example">
                                    <option selected>...</option>

                                    <option value="ar">Ar</option>
                                    <option value="tr">Tr</option>
                                    <option value="en">En</option>

                                </select>


                            </div>

                        </div>


                        <div class="row">
                            <div class="col">
                                <label for="country" class="mr-sm-2">{{ __('track.country') }}
                                </label>
                                <input type="text" class="form-control" name="country">

                            </div>
                            <div class="col">
                                <label for="address" class="mr-sm-2">{{ __('track.address') }}
                                </label>
                                <input type="text" class="form-control" name="address">


                            </div>
                            <div class="col">
                                <label for="address" class="mr-sm-2">{{ __('track.City') }}
                                </label>
                                <input type="text" class="form-control" name="city">


                            </div>


                        </div>
                        <div class="row">
                            <div class="col"><br>
                                <div class="form-group">
                                    <label for="academic_year">{{ __('track.ID_photo') }} <span
                                                class="text-danger">*</span></label><br>

                                    <div class="controls">
                                        <input type="file" accept="image/*" name="id_photo" class="form-control"
                                               id="id_photo"></div>
                                </div>
                            </div>


                        </div>


                        <div class="form-group">

                        </div>
                        <br><br>
                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-success">{{ __('track.submit') }}</button>
                </div>
                </form>


            </div>
        </div>
    </div>

    </div>
    </div>

    <!-- row closed -->
@endsection
@section('js')
 
@endsection
