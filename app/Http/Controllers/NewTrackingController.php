<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;
use App\Models\Tracking;
use App\Models\ClientAccount;
use App\Models\Payment;
use App\Models\Track_status;
use App\Models\Country;
use Validator;
use App\Models\TrackingType;
use App\Models\TrackMethod;
use App\Models\TrackingReport;
use Illuminate\Support\Carbon;
use Illuminate\Notifications\Notifiable;
use App\Events\NotificationEvent;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\tracknotification;
use App\Notifications\CategoryNot;
use App\Events\TrackEvent;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use DataTables;
use html;
use Auth;

class NewTrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function fetchtrack()
     {
       //  $data = Tracking::all();
		$data = Tracking::orderBy('updated_at', 'DESC')->get();
         $track =Tracking::all();
         $Track_sta = Track_status::all();
            $Countrys= Country::all();
            $trackTypes= TrackingType::all();
            $TrackMethod = TrackMethod::all();
            $tm =Tracking::with('trackmethod');

       return view('admin.ajax.tracking',compact('data','track','Track_sta','TrackMethod','Countrys','trackTypes'));
     //return$data;

     }


     // get Tracking

public function getTracknew(Request $request)
{
      $data = Tracking::query();
   // $data = Tracking::first()->get();
    return Datatables::of($data)
    
    ->addColumn('action', function($row){
        $actionBtn = '<div class="dropdown show">
           <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               العمليات
           </a>
           <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

               <a class="dropdown-item"id="updatestatus" data-id="' . $row->id . '" data-target="#updatestatusmodal" data-toggle="modal" ><i style="color: #0000cc" class="fa fa-edit"></i>&nbsp; edit tracking </a>
               <a class="dropdown-item" id="editedetails" data-id="' . $row->id . '"  data-target="#editedetailsmodal" data-toggle="modal" ><i style="color: #0000cc" class="fa  fa-clipboard"></i>&nbsp; تعديل تفاصيل الشحنة</a>

               <a class="dropdown-item" id="addvalue" data-id="' . $row->id . '" data-target="#addvaluemodal" data-toggle="modal"><i style="color: #0000cc" class="fa fa-dollar"></i>&nbsp;   add value </a>
               <a class="dropdown-item"  href="tracking-invoices/'.$row->id.'"><i style="color: #0000cc" class="fa fa-file-image-o"></i>&nbsp; اضافة صور الفواتير </a>
               <a class="dropdown-item"  id="deleteBtn" data-id="' . $row->id . '"><i style="color: red" class="fa fa-folder-open"></i>&nbsp;   trash </a>

           </div>
       </div>';

       return $actionBtn;
    })


        ->addColumn('Country', function(Tracking $Tracking){
            return $Tracking->Country->Country_Name;

         })

         ->addColumn('track_method', function(Tracking $Tracking){
            return $Tracking->trackmethod->method_name;

         })

         ->addColumn('type_tracking', function(Tracking $Tracking){
            return $Tracking->tracktype->tracking_type_name;

         })


         ->addColumn('Status_Name', function(Tracking $Tracking){


             return $Tracking->status->Status_Name;

         // return  $Tracking->status->Status_Name;



          })


        ->editColumn('created_at', function(Tracking $tracking) {
            return $tracking->created_at->toDateString();
        })
       ->rawColumns(['action'])

        ->make(true);

// }
}
  // End Get tracking





      //ADD NEW Tracking


 public function StoreTrack(Request $request){
        $validator = \Validator::make($request->all(),[
            'tracking_number' => 'required|unique:trackings|max:225',
            'code_number' => 'required|max:8',
            'tacking_status_id' => 'required|max:225',
        ]);

        $client_id = Client::where('code_number',$request->code_number)->first()->id ;
      //  $client = Client::where('code_number',$request->code_number)->where('status',1)->get() ;
   $client = Client::where('code_number',$request->code_number)->first();
        if(!$validator->passes()){
             return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            $Tracking = new Tracking();
           $Tracking->tracking_number = $request->tracking_number;
           $Tracking->code_number = $request->code_number;
           $Tracking->tacking_status_id = $request->tacking_status_id;
           $Tracking->country_id = $request->country_id;
           $Tracking->type_tracking_id= $request->type_tracking_id;
           $Tracking->track_method_id = $request->track_method_id;
           $Tracking->arrival_time = $request->arrival_time;
           $Tracking->pieces_number = $request->pieces_number;
           $Tracking->cartons_number = $request->cartons_number;
           $Tracking->weight = $request->weight;
           $Tracking->notes = $request->notes;
           $Tracking->user_id = Auth::user()->id;
           $Tracking->created_at = Carbon::now();

            $query = $Tracking->save();

            $TrackingReport = new TrackingReport();
            $TrackingReport->tracking_id = $Tracking->id;
            $TrackingReport->tacking_status_id = $request->tacking_status_id;
            $TrackingReport->tracking_number = $request->tracking_number;
            $TrackingReport->user = (Auth::user()->name);
            $Report = $TrackingReport->save();
          //  $user = User::all();
         $user = User::all();
          Notification::send($user, new tracknotification($request->tracking_number,$request->tacking_status_id,$request->code_number));
          Notification::send($client, new tracknotification($request->tracking_number,$request->tacking_status_id,$request->code_number));
          
          $m=__('track.Update track number').' '.$request->tracking_number.' '.__('track.to status').' '.($Tracking->status->Status_Name);
          event(new NotificationEvent($m,"user", 1, $request->tracking_number, $request->tacking_status_id));
          event(new NotificationEvent($m,"client", $client->id, $request->tracking_number, $request->tacking_status_id));
          $client = Client::where('code_number',$request->code_number)->get() ;
          foreach ($client as $c) {
            \App::setLocale($c->locale);
            $m=__('track.Update track number').' '.$request->tracking_number.' '.__('track.to status').' '.($track->status->Status_Name);
            event(new NotificationEvent($m,"client", $c->id, $request->tracking_number, $request->tacking_status_id));
            Mail::to($c->email)->send(new \App\Mail\WelcomeMail($c->name, $request->tracking_number,$Tracking->status->Status_Name,$request->tacking_status_id));
        }
			
            if(!$query){
                return response()->json(['code'=>0,'msg'=>'Something went wrong']);
            }else{

                return response()->json(['code'=>1,'msg'=>__("track.tracking added successfully")]);


            }





        }
   }

   // End Add New trackin

////////////////************************//////////// */

//GET track DETAILS

public function getTrackDetails(Request $request){
        $track_id = $request->track_id;
        $trackDetails = Tracking::find($track_id);
        return response()->json(['details'=>$trackDetails]);
    }

// End GET track DETAILS

/////////********************************** */

//UPDATE & ADD Value


public function updateTrackValue(Request $request){

    $update = Tracking::find($request->id);
    $client_id = Client::where('code_number',$request->code_number)->first()->id;
    $type=0;

    if ($update->invoice_value&&$update->invoice_value!=0.00) {
        $type=1;
        ClientAccount::create([
            'client_id' => $client_id,
            'credit' => 0.00,
            'Debit' => $update->invoice_value,
            'created_at' => Carbon::now(),
            'type'=>1


        ]);
    }
    ClientAccount::create([
        'client_id' => $client_id,
        'credit'=> $request->invoice_value,
        'Debit'=> 0.00,
        'created_at'=>Carbon::now(),



    ]);

    $update->invoice_value = $request->invoice_value;
    $update->updated_at=Carbon::now();
    $query= $update->save();



        if($query){
            return response()->json(['code'=>1, 'msg'=>'Value have Been updated']);
        }else{
            return response()->json(['code'=>0, 'msg'=>'Something went wrong']);
        }

}

  // END UPDATE & Add Value
/////////**************************** *///////////////

//Edite Detailes Tracking


public function EditeDetailsTrack(Request $request){

    $update = Tracking::find($request->id);
    $update->cartons_number = $request->cartons_number;
   $update->arrival_time = $request->arrival_time;
    $update->pieces_number = $request->pieces_number;
    $update->weight = $request->weight;
    $update->notes = $request->notes;
    $update->updated_at=Carbon::now();
    $update->user_id = Auth::user()->id;
    $query= $update->save();


        if($query){
            return response()->json(['code'=>1, 'msg'=>'Tracking Detailes have Been updated']);
        }else{
            return response()->json(['code'=>0, 'msg'=>'Something went wrong']);
        }

}



// Edit tracking DETAILS

///////////////****************************////////////////// */

/// Update StetusTrack



public function UpdateStetusTrack(Request $request)
{
    $client = Client::where('code_number',$request->code_number)->first();
    $update = Tracking::find($request->id);
    $update->tracking_number = $request->tracking_number;
    $update->code_number = $request->code_number;
    $update->track_method_id = $request->track_method_id;
    $update->tacking_status_id = $request->tacking_status_id;
    $update->updated_at=Carbon::now();
    $update->user_id = Auth::user()->id;

    $query= $update->save();

    TrackingReport::create([
        'tracking_id' => $request->id,
        'tracking_number'=> $request->tracking_number,
        'tacking_status_id'=> $request->tacking_status_id,
        'user' => (Auth::user()->name),

     ]);

     $user = User::all();
     Notification::send($user, new tracknotification($request->tracking_number,$request->tacking_status_id,$request->code_number));
     Notification::send($client, new tracknotification($request->tracking_number,$request->tacking_status_id,$request->code_number));

     $m=__('track.Update track number').' '.$request->tracking_number.' '.__('track.to status').' '.($update->status->Status_Name);
         event(new NotificationEvent($m,"user", 1, $request->tracking_number, $request->tacking_status_id));
         Mail::to('track.alpashagroup@gmail.com')->send(new \App\Mail\WelcomeMail("user", $request->tracking_number,$update->status->Status_Name,$request->tacking_status_id));


         app()->setLocale($client->locale);
         $m=__('track.Update track number').' '.$request->tracking_number.' '.__('track.to status').' '.($update->status->Status_Name);
         event(new NotificationEvent($m,"client", $client->id, $request->tracking_number, $request->tacking_status_id));
         Mail::to($client->email)->send(new \App\Mail\WelcomeMail($client->name, $request->tracking_number,$update->status->Status_Name,$request->tacking_status_id));

        if($query){
            return response()->json(['code'=>1, 'msg'=>'Tracking Detailes have Been updated']);
        }else{
            return response()->json(['code'=>0, 'msg'=>'Something went wrong']);
        }

}


/// End Update StetusTrack

///////////////****************************////////////////// */



    public function store(Request $request)
    {

    }











    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
