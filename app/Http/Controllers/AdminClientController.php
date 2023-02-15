<?php

namespace App\Http\Controllers;

use App\Notifications\ClientNotify;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\ClientAccount;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App;
use DataTables;

class AdminClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ClientIndexShow()
    {
        //$clients = Client::all();
        $clients = Client::orderBy('created_at', 'DESC')->latest()->get();

        return view('admin.clients.index',compact('clients'));
    }




   public function AddNewClient(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|max:25',
            'password' => 'required|max:15',
            'email' => 'required|email|unique:clients,email',
            'code_number' =>'required|unique:clients|max:8',
            'phone' => 'required|unique:clients|max:14',
            'country' => 'regex:/(^[A-Za-z0-9 ]+$)+/|max:15',
            'address' => 'regex:/(^[A-Za-z0-9 ]+$)+/|max:255',
            'city' => 'regex:/(^[A-Za-z0-9 ]+$)+/|max:15',
            'id_photo' => 'mimes:jpg,bmp,png'

        ],
        [
            // custom maseges

            'email' => 'email 8 chr',
            'code_number' => 'code number 8 chr',

        ]);

        try {
                  $data= array();
                   $data['name'] = $request->name;
                   $data['password'] = bcrypt($request->password);
                   $data['email'] = $request->email;
                  $data['code_number'] = $request->code_number;
                 $data['locale'] = $request->locale;
                 $data['phone'] = $request->phone;
                $data['country'] = $request->country;
                $data['address'] = $request->address;
                $data['city'] = $request->city;


                $data['created_at'] = Carbon::now();


                if ($request->file('id_photo')) {
                    $file = $request->file('id_photo');

                    $filename = $request->code_number.$file->getClientOriginalName();
                    $file->move(public_path('../../upload/client/idphoto'),$filename);
                    $data['id_photo'] = $filename;
                }

                //  if ($request->file('id_photo')) {

                    //  $data['id_photo'] = $request->file('id_photo')->store('../../upload/client/idphoto');
                //  }

                 DB::table('clients')->insert($data);

                 $client_id = Client::where('code_number',$request->code_number)->first()->id ;

                 ClientAccount::create([
                  'client_id' => $client_id,
                  'credit'=> 0.00,
                  'Debit'=> 0.00,
                  'created_at'=>Carbon::now()


              ]);
              return redirect()->back()->with(['success' , 'تم اضافة العميل بنجاح ']);


              }
              catch
              (\Exception $e) {
                  return redirect()->back()->withErrors(['error' => $e->getMessage()]);
              }

          } // end mehtod






    public function ClientView($id)
    {
        $client = Client::find($id);

        return view('admin.clients.show',compact('client'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function ClientActive(Request $request, $id)
    {
        try {
            $clients = Client::all();
            $update = Client::find($id);


            $update->status = $request->status;
           $update->save();

           if($request->status==1){
           $client = Client::find($id);
               App::setLocale($client->locale);
               Mail::to($client->email)->send(new \App\Mail\ClientActivation($client->name, $client->code_number,));

            }



       return Redirect()->route('all.clients.show')->with('success','تم تفعيل الحساب بنجاح  ');

   }
   catch
   (\Exception $e) {
       return redirect()->back()->withErrors(['error' => $e->getMessage()]);
   }




    }




    public function UpdateClient(Request $request, $id)
    {



        try {
            $client = Client::find($id);


            $client->name = $request->name;
            if($request->password)
            $client->password = bcrypt($request->password);
            $client->email = $request->email;
            $client->phone = $request->phone;
            $client->code_number = $request->code_number;
            $client->locale = $request->locale;
            $client->updated_at=Carbon::now();
//            dd($request->all());

if ($request->file('id_photo')) {
    $file = $request->file('id_photo');

    $filename = $request->code_number.$file->getClientOriginalName();
    $file->move(public_path('../../upload/client/idphoto'),$filename);
    $data['id_photo'] = $filename;
}


         //  if ($request->hasFile('id_photo')) {
          //      Storage::delete($client->id_photo);
          //      $client->id_photo = $request->file('id_photo')->store('upload/client/idphoto');
         //   }
           $client->save();


       return Redirect()->route('all.clients.show')->with('success','تم تحديث  بنجاح ');

   }
   catch
   (\Exception $e) {
       return redirect()->back()->withErrors(['error' => $e->getMessage()]);
   }



    }


    public function DeleteClient($id){

        $client = Client::find($id)->Delete();

        return Redirect()->back()->with('success','تم حذف  بنجاح ');

     }



     ///// AJAX /////////////////////



     public function ClientsAjaxAll()
    {
        //$clients = Client::all();
        $clients = Client::orderBy('created_at', 'DESC')->latest()->get();

        return view('admin.clients.ajax.index',compact('clients'));
    }


    public function GetAllClients(Request $request)
    {

        $data = Client::query();
        return Datatables::of($data)
        ->addColumn('action', function($row){
            $actionBtn = '
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
            data-target="#activemodal" id="activestatus" data-id="' . $row->id . '"
            title="تفعيل الحساب"><i class="fa fa-check"></i></button>

    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
            data-target="#Notifymodal"  id="clientnotify" data-id="' . $row->id . '"
            title="ارسال اشعار"><i class="fa fa-send"></i></button>

    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
            data-target="#edit"
            title="تعديل البيانات"><i class="fa fa-edit"></i></button>


    <button style="background-color: #ffc135;" type="button"
            class="btn btn-info btn-sm"

            title="عرض البيانات"><a href=""><i
                    style="color: #ffffff;" class="fa fa-eye"></i></a></button>


    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
            data-target="#delete"
            title="حذف"><i
                class="fa fa-trash"></i></button>



            ';

           return $actionBtn;
        })


        ->editColumn('created_at', function(Client $Client) {
            return $Client->created_at->toDateString();
        })

        ->editColumn('image', function(Client $Client) {
            return $Client->profile_photo_path;
        })
       ->rawColumns(['action'])

        ->make(true);

    }


////////////////************************//////////// */

//GET client DETAILS

public function getClientDetails(Request $request){
    $Client_id = $request->Client_id;
    $ClientDetails = Client::find($Client_id);
    return response()->json(['details'=>$ClientDetails]);
}

// End GET client DETAILS

/////////********************************** */


//UPDATE & active status


public function ActiveStatus(Request $request){

    $update = Client::find($request->id);
   // $client_id = Client::where('code_number',$request->code_number)->first()->id;

   $update->status = $request->status;

   $query= $update->save();
   if($request->status==1){
   $client = Client::find($request->id);
       App::setLocale($client->locale);
       Mail::to($client->email)->send(new \App\Mail\ClientActivation($client->name, $client->code_number,));

    }


        if($query){
            return response()->json(['code'=>1, 'msg'=>'client have Been Active']);
        }else{
            return response()->json(['code'=>0, 'msg'=>'Something went wrong']);
        }

}

  // END UPDATE & Active Status
/////////**************************** *///////////////









    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    public function ClientNotify(Request $request,$id){
        $c=Client::findOrFail($id);
        Notification::send($c, new ClientNotify($request->text,'client',$id));
        return Redirect()->route('all.clients.show')->with('success','تم الارسال  بنجاح ');

//        event(new NotificationEvent($m,"client", $c->id, $trace->tracking_number, $trace->tacking_status_id));
//        Mail::to($c->email)->send(new \App\Mail\WelcomeMail($c->name, $trace->tracking_number,$trace->status->Status_Name));
    }

    public function SendNotify(Request $request){
        $c=Client::findOrFail($request->id);
        Notification::send($c, new ClientNotify($request->text,'client',$request->id));
       // return Redirect()->route('all.clients.show')->with('success','تم الارسال  بنجاح ');
       $query = $request->text;
       if($query != null){
        return response()->json(['code'=>1, 'msg'=>'Send Notification to Client']);
    }else{
        return response()->json(['code'=>0, 'msg'=>'Something went wrong']);
    }
//        event(new NotificationEvent($m,"client", $c->id, $trace->tracking_number, $trace->tacking_status_id));
//        Mail::to($c->email)->send(new \App\Mail\WelcomeMail($c->name, $trace->tracking_number,$trace->status->Status_Name));
    }



}
