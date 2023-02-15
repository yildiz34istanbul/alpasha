<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           
        {{__('track.Edit Tracking')}}<b>  </b>
          

        </h2>
    </x-slot>

    <div class="py-12"> 
   <div class="container">
    <div class="row">

 

    <div class="col-md-9"> 
                    <div class="card">
                        <div class="card-header">{{__('track.Edit Tracking')}}</div>
                        <div class="card-body">

                    <form action="{{ url('tracking/update/'.$tracking->id)  }}" method="POST">
                      @csrf 
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">{{__('track.Tracking Number')}}</label>
                        <input type="number" name="tracking_number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $tracking->tracking_number }}">
                        @error('tracking_number')

                        <span class="text-danger"> {{$message}}</span>
                        @enderror


                        <label for="exampleInputEmail1" class="form-label">{{__('track.Code Number')}}</label>
                        <input type="number" name="code_number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $tracking->code_number }}">
                        @error('code_number')

                        <span class="text-danger"> {{$message}}</span>
                        @enderror

                        <label for="exampleInputEmail1" class="form-label">{{__('track.Tracking Status')}}</label>
                        <select class="form-select"  name="tacking_status" aria-label="Default select example">
  <option selected >--</option>
  <option value="{{__('track.track 1')}}">{{__('track.track 1')}} </option>
  <option value="{{__('track.track 2')}}" >{{__('track.track 2')}}</option>
  <option value="{{__('track.track 3')}}">{{__('track.track 3')}}</option>
  <option value="{{__('track.track 4')}}">{{__('track.track 4')}}</option>
  <option value="{{__('track.track 5')}}">{{__('track.track 5')}}</option>
  <option value="{{__('track.track 6')}}">{{__('track.track 6')}}</option>
  <option value="{{__('track.track 7')}}">{{__('track.track 7')}}</option>
  
</select>

                    </div>
                   
                    <button type="submit" class="btn btn-primary">Update Tracking</button>
                    </form>
                    </div>

                        </div>
                         </div>


    </div>
  </div> 

    </div>
</x-app-layout>
