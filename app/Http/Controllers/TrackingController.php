<?php

namespace App\Http\Controllers;

use App\Events\NotificationEvent;
use Illuminate\Http\Request;
use App\Models\Tracking;
use App\Models\Track_status;
use App\Models\Country;
use App\Models\Client;
use App\Models\TrackingType;
use App\Models\TrackMethod;
use App\Models\TrackingReport;
use App\Models\ClientAccount;
use Auth;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Mail;
use PDF;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Notifications\Notifiable;

use Illuminate\Support\Facades\Notification;
use App\Notifications\tracknotification;
use App\Notifications\CategoryNot;
use App\Events\TrackEvent;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TrackingImport;
use App\Imports\TrackingReportImport;
use App\Imports\ClientAccountImport;


class TrackingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function AllTrack(Request $request){

        if($request->has('search')){

            $trackings= Tracking::where('tracking_number','LIKE','%'.$request->search.'%')->paginate(3);

        }else{

           // $trackings= Tracking::latest()->get();
			// $trackings= Tracking::where('tacking_status_id', '!=', 8)->get();
           // $trackings= Tracking::orderBy('updated_at', 'DESC')->paginate(25);
			 $trackings= Tracking::orderBy('updated_at', 'DESC')->get();
        }

       $trachtrack = Tracking::onlyTrashed()->latest()->get();

       $Track_sta = Track_status::all();
       $Countrys= Country::all();
       $trackTypes= TrackingType::all();
       $TrackMethod = TrackMethod::all();

        return view('tracking.index',compact('trackings','trachtrack','Track_sta','Countrys','trackTypes','TrackMethod'));
    }



    public function AddTrack(Request $request ){
        
          $validated = $request->validate([
            'tracking_number' => 'required|unique:trackings|max:225',
            'code_number' => 'required|max:8',
            'tacking_status_id' => 'required|:trackings|max:225',
            'cartons_number' => 'max:8',
            'pieces_number' => 'max:8',
            'weight' => 'max:8',
            'notes' => 'max:225',

        ],

        [
            // custom maseges
            'tracking_number.required' => __('track.pless_input'),
            'code_number.max' => 'max 8 chr',

        ]);

        try {
        $validated = $request->validate([
            'tracking_number' => 'required|unique:trackings|max:225',
            'code_number' => 'required|max:8',
            'tacking_status_id' => 'required|:trackings|max:225',

        ],

        [
            // custom maseges
            'tracking_number.required' => __('track.pless_input'),
            'code_number.max' => 'max 8 chr',

        ]);
        $client_id = Client::where('code_number',$request->code_number)->first()->id ;
        $client = Client::where('code_number',$request->code_number)->get() ;

        // insert data with method
       $track=Tracking::create([

            'tracking_number'=> $request->tracking_number,
            'code_number'=> $request->code_number,
            'tacking_status_id'=> $request->tacking_status_id,
            'country_id'=>$request->country_id,
            'type_tracking_id'=>$request->type_tracking_id,
            'track_method_id'=>$request->track_method_id,
           // 'invoice_value' => $request->invoice_value,
            'arrival_time' => $request->arrival_time,
            'pieces_number' => $request->pieces_number,
            'cartons_number' => $request->cartons_number,
             'weight' => $request->weight,
            'notes' => $request->notes,
            'user_id'=> Auth::user()->id,
           'created_at'=>Carbon::now()

        ]);
        //$Tracking_id = Tracking::latest()->first()->id;
        TrackingReport::create([
            'tracking_id' => $track->id,
            'tacking_status_id'=> $request->tacking_status_id,
            'tracking_number'=> $request->tracking_number,
            'user' => (Auth::user()->name),
        ]);



    $user = User::all();
          //  Notification::send($user, new tracknotification($request->tracking_number,$request->tacking_status));
         Notification::send($user, new CategoryNot($request->tracking_number,$request->code_number));
         Notification::send($client, new CategoryNot($request->tracking_number,$request->code_number));


            foreach ($user as $u) {
                \App::setLocale($u->locale);
                $m=__('track.Update track number').' '.$request->tracking_number.' '.__('track.to status').' '.($track->status->Status_Name);
                event(new NotificationEvent($m,"user", $u->id, $request->tracking_number, $request->tacking_status_id));
                Mail::to($u->email)->send(new \App\Mail\WelcomeMail($u->name, $request->tracking_number,$track->status->Status_Name,$request->tacking_status_id));
            }
            foreach ($client as $c) {
                \App::setLocale($c->locale);
                $m=__('track.Update track number').' '.$request->tracking_number.' '.__('track.to status').' '.($track->status->Status_Name);
                event(new NotificationEvent($m,"client", $c->id, $request->tracking_number, $request->tacking_status_id));
                Mail::to($c->email)->send(new \App\Mail\WelcomeMail($c->name, $request->tracking_number,$track->status->Status_Name,$request->tacking_status_id));
            }
        return Redirect()->back()->with('success', __("track.tracking added successfully") );

    }

    catch (\Exception $e){
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

    }


    public function Edit($id){

        $tracking = Tracking::find($id);


        return view('tracking.edit', compact('tracking'));

    }





    public function Update(Request $request , $id){

 $client = Client::where('code_number',$request->code_number)->get() ;

             $update = Tracking::find($id);
             $update->tracking_number = $request->tracking_number;
             $update->code_number = $request->code_number;
             $update->track_method_id = $request->track_method_id;
             $update->tacking_status_id = $request->tacking_status_id;
             $update->updated_at=Carbon::now();
             $update->user_id = Auth::user()->id;
            $update->save();

            TrackingReport::create([
               'tracking_id' => $id,
               'tracking_number'=> $request->tracking_number,
               'tacking_status_id'=> $request->tacking_status_id,
               'user' => (Auth::user()->name),

           ]);

            $user = User::all();
          //  Notification::send($user, new tracknotification($request->tracking_number,$request->tacking_status_id));
             Notification::send($user, new tracknotification($request->tracking_number,$request->tacking_status_id,$request->code_number));
            Notification::send($client, new tracknotification($request->tracking_number,$request->tacking_status_id,$request->code_number));
           
		   foreach ($client as $c) {
                app()->setLocale($c->locale);
                $m=__('track.Update track number').' '.$request->tracking_number.' '.__('track.to status').' '.($update->status->Status_Name);
                event(new NotificationEvent($m,"client", $c->id, $request->tracking_number, $request->tacking_status_id));
                Mail::to($c->email)->send(new \App\Mail\WelcomeMail($c->name, $request->tracking_number,$update->status->Status_Name,$request->tacking_status_id));
            }
		
		foreach ($user as $u) {
                app()->setLocale($u->locale);
                $m=__('track.Update track number').' '.$request->tracking_number.' '.__('track.to status').' '.($update->status->Status_Name);
                event(new NotificationEvent($m,"user", $u->id, $request->tracking_number, $request->tacking_status_id));
                Mail::to($u->email)->send(new \App\Mail\WelcomeMail($u->name, $request->tracking_number,$update->status->Status_Name,$request->tacking_status_id));
            }
         

             return Redirect()->route('tracking.all')->with('success','تم تحديث الشحنة بنجاح ' );






    }

    public function AddValue(Request $request , $id){
        
         $validated = $request->validate([
            'invoice_value' => 'max:8',

        ],

        [
            // custom maseges
           
            'invoice_value.max' => 'max 8 chr',

        ]);
        
        $client_id = Client::where('code_number',$request->code_number)->first()->id ;
        $update = Tracking::find($id);

        $type=0;
        // return $ClientAccount;
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
        // $update->arrival_time = $request->arrival_time;
        $update->invoice_value = $request->invoice_value;
        $update->updated_at=Carbon::now();
        $update->user_id = Auth::user()->id;
        $update->save();
        return Redirect()->route('tracking.all')->with('success',__("track.tracking update successfully") );

    }


    public function UpdatValuePieces(Request $request , $id){
      //  $client_id = Client::where('code_number',$request->code_number)->first()->id ;
        $update = Tracking::find($id);
        $update->cartons_number = $request->cartons_number;
       // $update->invoice_value = $request->invoice_value;
       $update->arrival_time = $request->arrival_time;
        $update->pieces_number = $request->pieces_number;
        $update->weight = $request->weight;
        $update->notes = $request->notes;
        $update->updated_at=Carbon::now();
        $update->user_id = Auth::user()->id;
       $update->save();


   // $ClientAccount=ClientAccount::where('credit',$request->invoice_value)->where('client_id',$client_id)->get();

   // return $ClientAccount;
      // ClientAccount::create([
       //    'client_id' => $client_id,
        //   'credit'=> $request->invoice_value,
        //   'Debit'=> 0.00,
        //   'created_at'=>Carbon::now()


     //  ]);
       return Redirect()->route('tracking.all')->with('success',__("track.tracking update successfully") );

    }



  public function SoftDelete($id){

    $delete = Tracking::find($id)->Delete();
    return Redirect()->back()->with('success',__("track.tracking Added to archive"));


  }

  public function Archives(Request $request ){

    if($request->has('search')){

        $trackings= Tracking::where('tracking_number','LIKE','%'.$request->search.'%')->paginate(3);

    }else{

        $trackings= Tracking::latest()->paginate(10);

    }

   $trachtrack = Tracking::onlyTrashed()->latest()->get();

   $Track_sta = Track_status::all();
 // $Track_status= DB::table('trackings')
  //  ->join('track_statuses','trackings.track_statuses.id','track_statuses.id')
   // ->select('trackings.*','track_statuses.Status_Name')
   // ->get();


   //$noty = Auth::user()->unreadNotifications;
   $Countrys= Country::all();


   // $trackings=DB::table('trackings')->latest()->paginate(5);

    return view('tracking.archives',compact('trackings','trachtrack','Track_sta','Countrys'));

  }



  public function Restore($id){

    $delete = Tracking::withTrashed()->find($id)->restore();

    return Redirect()->back()->with('success',"تم استعادة الشحنة بنجاح ");

  }


 public function Delete($id){

    $delete = Tracking::onlyTrashed()->find($id)->forceDelete();

    return Redirect()->back()->with('success', __("track.tracking Deleted successfully"));

 }


 /////////*******      UpdateTracking       ********** */


 public function UpdateTracking(Request $request){

    if($request->has('search')){

        $trackings= Tracking::where('tracking_number','LIKE','%'.$request->search.'%')->paginate(3);

    }else{

        
        $trackings= Tracking::orderBy('updated_at', 'DESC')->get();
    }

   $trachtrack = Tracking::onlyTrashed()->latest()->paginate(6);

   $Track_sta = Track_status::all();
 // $Track_status= DB::table('trackings')
  //  ->join('track_statuses','trackings.track_statuses.id','track_statuses.id')
   // ->select('trackings.*','track_statuses.Status_Name')
   // ->get();
     if(isset($_GET['not_id']))
     DatabaseNotification::where('id',$_GET['not_id'])->update([
         'read_at'=>Carbon::now()
     ]);
   $noty = Auth::user()->unreadNotifications;
   $Countrys= Country::all();


   // $trackings=DB::table('trackings')->latest()->paginate(5);

    return view('tracking.updated-tracking',compact('trackings','trachtrack','Track_sta','noty','Countrys'));
}







public function Update_all(Request $request)
{

    $update_all = $request->update_all_id;


    $update_all_id = explode(",", $request->update_all_id);
    $user=User::all();

   $trackings= Tracking::whereIn('id', $update_all_id)->update(['tacking_status_id' => $request->tacking_status_id]);
   $trackings= Tracking::whereIn('id', $update_all_id)->get();
   foreach($trackings as $trace){
    TrackingReport::create([
        'tracking_id' => $trace->id,
        'tracking_number'=> $trace->tracking_number,
        'tacking_status_id'=> $trace->tacking_status_id,
        'user' => (Auth::user()->name),

    ]);
       Notification::send($user, new tracknotification($trace->tracking_number,$trace->tacking_status_id,$trace->code_number));
       Notification::send(Client::where('code_number',$trace->code_number)->get(), new tracknotification($trace->tracking_number,$trace->tacking_status_id,$trace->code_number));

          }
       foreach (Client::where('code_number',$trace->code_number)->get() as $c) {
           app()->setLocale($c->locale);
           $m=__('track.Update track number').' '.$trace->tracking_number.' '.__('track.to status').' '.($trace->status->Status_Name);
           event(new NotificationEvent($m,"client", $c->id, $trace->tracking_number, $trace->tacking_status_id));
           Mail::to($c->email)->send(new \App\Mail\WelcomeMail($c->name, $trace->tracking_number,$trace->status->Status_Name,$request->tacking_status_id));
       }
	   
	   foreach ($user as $u) {
           app()->setLocale($u->locale);
           $m=__('track.Update track number').' '.$trace->tracking_number.' '.__('track.to status').' '.($trace->status->Status_Name);
           event(new NotificationEvent($m,"user", $u->id, $trace->tracking_number, $trace->tacking_status_id));
           Mail::to($u->email)->send(new \App\Mail\WelcomeMail($u->name, $trace->tracking_number,$trace->status->Status_Name,$request->tacking_status_id));
    
   }



   return Redirect()->back()->with('success', __("track.tracking Deleted successfully"));

}











 public function TrackPdf($id){

    $data['details'] = Tracking::with(['user','status','Country','tracktype'])->where('id',$id)->first();

	$pdf = PDF::loadView('tracking.pdf.document', $data);
	$pdf->SetProtection(['copy', 'print'], '', 'pass');
	return $pdf->stream('document.pdf');
 }


   /// import excel file ///

   public function TrackExcelimport(Request $request )
   {
    $request->validate([
        'file' => 'required|file|mimes:xls,xlsx',
    ]);

    $trachtrack = Tracking::onlyTrashed()->latest()->paginate(5);
    $trackings= Tracking::latest()->paginate(10);
    $Track_sta = Track_status::all();
    $Countrys= Country::all();
    $trackTypes= TrackingType::all();
    $TrackMethod = TrackMethod::all();

       Excel::import(new TrackingImport, $request->file);
       Excel::import(new TrackingReportImport, $request->file);
       Excel::import(new ClientAccountImport, $request->file);


       return Redirect()->back()->with('success',  'تم رفع الملف بنجاح' );
      // return view('tracking.index',compact('trackings','trachtrack','Track_sta','Countrys','trackTypes','TrackMethod'));

   }








}
