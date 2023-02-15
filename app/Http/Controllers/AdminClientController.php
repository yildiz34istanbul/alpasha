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

class AdminClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ClientIndexShow()
    {
       // $clients = Client::all();
		
          $clients = Client::orderBy('created_at', 'DESC')->latest()->get();
		//$clients = Client::orderBy('created_at', 'DESC')->paginate(25);
        return view('admin.clients.index',compact('clients'));
    }




   public function AddNewClient(Request $request)
    {
 $validated = $request->validate([
            'name' => 'required|max:25',
            'password' => 'required|max:15',
            'email' => 'required|email|unique:clients,email',
            'code_number' =>'required|unique:clients|max:8',
           'phone' => 'required|unique:clients|max:15',
            'country' => 'required|min:3|max:50',
            'address' => 'required|min:3|max:100',
            'city' => 'required|min:3|max:30',
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

                      $data['id_photo'] = $request->file('id_photo')->store('/upload/client/idphoto');
                  }

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
			$client->country = $request->country;
            $client->city = $request->city;
            $client->address = $request->address;
            $client->updated_at=Carbon::now();
//            dd($request->all());
         
		if ($request->file('id_photo')) {
    		$file = $request->file('id_photo');
    		@unlink(public_path('../../upload/client/idphoto/'.$file));
    		$filename = date('YmdHi').$file->getClientOriginalName();
    		$file->move(public_path('../../upload/client/idphoto'),$filename);
    		$client->id_photo = $filename;
    	}		
			
// if ($request->hasFile('id_photo')) {
          //      Storage::delete($client->id_photo);
             //   $client->id_photo = $request->file('id_photo')->store('public/client_ids');
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
}
