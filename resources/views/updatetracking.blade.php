<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Update Tracking <b> </b>
            <b style="float:right">Total Tracking
            <span class="badge bg-danger">  </span>
        </b>

        </h2>
    </x-slot>

    <div class="py-12">


        <div class="container">
            <div class="row">

            <div class="row g-3 align-items-center mb-2">
            
  <div class="col-auto">
  <form action="{{route('tracking.all')}}" method="GET">
    <label for="inputPassword6" class="col-form-label">Search</label>
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
                    <div class="card">

                      @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('success')}}</strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                      @endif


                        <div class="card-header">
                        <h6 class="display-6">All Tracking</h6>
                        
                      
                      </div>

                   

            <div  class="table-responsive"> 
            <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Tracking Number</th>
      <th scope="col">Code Number</th>
      <th scope="col" class="table-info">Tracking Status</th>
      <th scope="col">User</th>
      <th scope="col">Updated at</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

    
  @foreach($trackings as $track)
    <tr>
      <th scope="row">{{$trackings->firstItem()+$loop->index}}</th>
      <td >{{$track->tracking_number}}</td>
      <td>{{$track->code_number}}</td>
      <td class="table-info">{{$track->tacking_status}}</td>
      <td class="link-info">{{$track->user->name}}</td>
      <td>
        @if($track->updated_at == NULL)
        <span class="text-danger"> No Date</span>
         @else
        {{Carbon\Carbon::parse($track->updated_at)->diffForHumans()}}
        
        @endif
      
      </td>
      <td>
        <a href="{{url('tracking/edit/'.$track->id)}}" class="btn btn-info">Edit</a>
        
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
                        <div class="card-header">Add Tracking</div>
                        <div class="card-body">

                    <form action="{{route('store.tracking')}}" method="POST">
                      @csrf 
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tracking Number</label>
                        <input type="number" name="tracking_number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        @error('tracking_number')

                        <span class="text-danger"> {{$message}}</span>
                        @enderror


                        <label for="exampleInputEmail1" class="form-label">Code Number</label>
                        <input type="number" name="code_number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        @error('code_number')

                        <span class="text-danger"> {{$message}}</span>
                        @enderror

                        <label for="exampleInputEmail1" class="form-label">Tracking Status</label>
                        <select class="form-select"  name="tacking_status" aria-label="Default select example">
  <option selected >--</option>
  <option value="one">One</option>
  <option value="Tow" >Tow</option>
  <option value="Three">Three</option>
  
</select>

                    </div>
                   
                    <button type="submit" class="btn btn-dark">Add Tracking</button>
                    </form>
                    </div>

                        </div>
                         </div>

            </div>
            </div>














 
</div>

</div>


                    <div class="col-md-3"> 
                    

            
            </div>











    </div>
</x-app-layout>
