<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Mail\NotifiMail;
use App\Mail\DeleteAccount;
use Illuminate\Http\Request;
use Auth;
use App\Models\Client;
use App\Models\User;
use App\Models\Tracking;
use App\Models\Payment;
use App\Models\ClientInvoices;
use App\Models\ClientAccount;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App;

class ClientController extends Controller
{


    //  public function __construct()
    // {
    // parent::__construct();
    // $this->middleware(['Client'])->except(['ClientIndex','ClientRegister','ClientLogin','ClientRegisterCreate']);
    //  }



    public function ClientIndex(){
        return view('clients.client_login');
    } // END METHOD





    public function ClientDashboard(){
        $clients_id = Auth::guard('client')->user()->id;
        $client_code_number =Auth::guard('client')->user()->code_number;
        $client_Debit = ClientAccount::where('client_id',$clients_id)->sum('Debit');
        $client_Debit2 = ClientAccount::where('client_id',$clients_id)->where('type',1)->sum('Debit');
        $client_credit = ClientAccount::where('client_id',$clients_id)->sum('credit');
        $client_account = $client_Debit- $client_credit;
        $client_credit=$client_credit-$client_Debit2;
        $track_st = Tracking::select('*')->where('tacking_status_id','=',1)->where('code_number',$client_code_number)->get();
        $client_cartons_number_count = Tracking::where('code_number',$client_code_number)->sum('cartons_number');
        $client_pieces_number_count = Tracking::where('code_number',$client_code_number)->sum('pieces_number');
        $client_trackings_u= Tracking::where('code_number',$client_code_number)->orderBy('updated_at', 'DESC')->paginate(3);
        $Air_track=Tracking::where('code_number',$client_code_number)->where('track_method_id', 1)->count();
        $Sea_track=Tracking::where('code_number',$client_code_number)->where('track_method_id', 2)->count();
        $land_track=Tracking::where('code_number',$client_code_number)->where('track_method_id', 3)->count();
        $client_tracking_count = Tracking::where('code_number',$client_code_number)->count();
      

        return view('clients.dashboard',compact('client_account','client_tracking_count','client_credit','track_st','client_code_number','client_cartons_number_count','client_pieces_number_count','client_trackings_u','Air_track','Sea_track','land_track'));


    }// END METHOD


    public function ClientLogin(Request $request){
        // dd($request->all());

        $check = $request->all();
        if(Auth::guard('client')->attempt(['email' => $check['email'], 'password' => $check['password'] , 'status' => 1 ])){

            $code = random_int(1000, 9999);
            if(\auth('client')->user()->is_confirmed==0) {
                \auth('client')->user()->confirm_code = $code;

                \auth('client')->user()->save();

//            User::sendNotifiSMS($user->mobile,' رمز التأكيد الخاص بك هو  '.$code);
                Mail::to(auth('client')->user()->email)->send(new NotifiMail(' رمز التأكيد الخاص بك هو  ' . $code));
            }

            return redirect()->route('client.dashboard')->with('success',' Login Successfully');
        }else{
            return back()->with('error','Invaild Email Or Password');
        }

    } // end mehtod


    public function ClientLogout(){

        Auth::guard('client')->logout();
        return redirect()->route('client_login_from')->with('success','Seller Logout Successfully');
    } // end mehtod

    public function ClientRegister(){
        return view('clients.client_register');
    }// end mehtod
     
	public function ClientbeforeLogin(){
        return view('clients.before_login');
    }// end mehtod

    public function ClientRegisterCreate(Request $request){
        
         $validated = $request->validate([
            'name' => 'required|max:15',
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

        // dd($request->all());
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

            // $data['id_photo'] = $request->id_photo;
            $data['created_at'] = Carbon::now();


            if ($request->file('id_photo')) {
                $file = $request->file('id_photo');
                //	$path = 'client';
                // @unlink(public_path('../../upload/client'.$data->id_photo));
                $filename = $request->code_number.$file->getClientOriginalName();
                // $file->storeAs('client/idphoto/'.$request->code_number, $file->getClientOriginalName(),'clients');
                $file->move(public_path('../../upload/client/idphoto'),$filename);
                $data['id_photo'] = $filename;
            }

            DB::table('clients')->insert($data);

            $client_id = Client::where('code_number',$request->code_number)->first()->id ;
			$client_name = Client::where('code_number',$request->code_number)->first()->name ;

            ClientAccount::create([
                'client_id' => $client_id,
                'credit'=> 0.00,
                'Debit'=> 0.00,
                'created_at'=>Carbon::now()


            ]);
			 $user = User::all();
            foreach ($user as $u) {
                \App::setLocale($u->locale);
               // Mail::to($u->email)->send(new NotifiMail(' تم تسجيل عميل جديد  '. $client_name));
                Mail::to($u->email)->send(new \App\Mail\NewClient($request->name, $request->code_number,));
            }

            //return redirect()->route('client_login_from')->with('error','يرجى تسجيل الدخول ');
			return redirect()->route('client_before_login');
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    } // end mehtod






    public function ClientProfileView(){
        $id = Auth::guard('client')->user()->id;
        $client = Client::find($id);

        return view('clients.profile.view_profile',compact('client'));
    }

    public function ClientProfileEdit(){
        $id = Auth::guard('client')->user()->id;
        $client = Client::find($id);
        return view('clients.profile.edit_profile',compact('client'));
    }




    public function ClientProfileStore(Request $request){


        $validated = $request->validate([
            'name' => 'required|max:15',
            'country' => 'required|max:100',
            'address' => 'required|max:255',
            'city' => 'required|max:100',
            'id_photo' => 'mimes:jpg,bmp,png'

        ],
        [
            // custom maseges

            'address' => 'address 255 chr',
            'city' => 'city 100 chr',

        ]);

        $data = Client::find(Auth::guard('client')->user()->id);
        $data->name = $request->name;
       // $data->email = $request->email;
      //  $data->phone = $request->phone;
        $data->country = $request->country;
        $data->address = $request->address;
        $data->locale = $request->locale;
        // $data->password = bcrypt($request->password);


        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('../../upload/client_images/'.$data->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('../../upload/client_images'),$filename);
            $data['profile_photo_path'] = $filename;
        }







        $data->save();

        //$notification = array(
        //	'message' => 'User Profile Updated Successfully',
        //	'alert-type' => 'success'
//	);

        return redirect()->route('ClientProfile.View');

    } // End Method




    public function ClientPasswordView(){

        $id = Auth::guard('client')->user()->id;
        $client = Client::find($id);

        return view('clients.profile.update-password',compact('client'));



    }




    public function ClientPasswordUpdate(Request $request){

        $validated = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',


        ]);
        $haspassword = Auth::guard('client')->user()->password;
        if(Hash::check($request->oldpassword,$haspassword)){

            $client = Client::find(Auth::guard('client')->user()->id);
            $client->password = Hash::make($request->password);
            $client->save();
            Auth::guard('client')->logout();
            return redirect()->route('client_login_from');
        }else{
            return redirect()->back()->with('errors', __("track.error password") );

        }



    }






    public function ClientTrackShow(){
        $client_id = Auth::guard('client')->user()->id;
        if(isset($_GET['not_id']))
        DatabaseNotification::where('id',$_GET['not_id'])->update([
            'read_at'=>Carbon::now()
        ]);
        $code_number = Client::where('id', $client_id)->value('code_number');

        //  $code_number = DB::Table('clients')->select('code_number')->where('id',$client_id)->first();
        $track = Tracking::where('code_number', $code_number)->get();

        //  return    $track;






        return view('clients.tracking.index',compact('track'));
    } // END METHOD




    public function ClientPaymentShow(){
        $client_id = Auth::guard('client')->user()->id;
        // $client_tracking = Client::with('tracking')->find($client_id);
        // return $client_tracking;
        $code_number = Client::where('id', $client_id)->value('code_number');

        //  $code_number = DB::Table('clients')->select('code_number')->where('id',$client_id)->first();
        $track = Tracking::where('code_number', $code_number)->get();

        //  return    $track;


        $payment = Payment::where('client_id', $client_id)->get();

        //return $payment ;

        return view('clients.payment.index',compact('payment'));
    } // END METHOD






    public function ClientinvoiceShow(){
        $client_id = Auth::guard('client')->user()->id;
        $code_number = Client::where('id', $client_id)->value('code_number');
        $invoices = ClientInvoices::where('code_number', $code_number)->get();

        return view('clients.invoices.index',compact('invoices'));
    } // END METHOD
    
     public function ClientTrackinvoice($id){

        $track_n = Tracking::where('id',$id)->value('tracking_number');
         $trackinvoices = ClientInvoices::where('tracking_id', $track_n)->get();

        return view('clients.invoices.trackinvoices',compact('trackinvoices'));
     } // END METHOD




    public function confirm(Request $request){

        $user = auth()->user();
        if ($request->code==$user->confirm_code) {
            auth('client')->user()->is_confirmed=1;
            auth('client')->user()->confirm_code=0;
            auth('client')->user()->save();

                return redirect()->route('client.dashboard');
        }else{
            \session()->put('code','الرمز غير مطابق');
            return redirect()->back()->withErrors(['code'=>'الرمز غير مطابق']);
        }
    }


	
	 public function ClientDeleteAccount(){
        $client_id = Auth::guard('client')->user()->id;
        $code_number = Client::where('id', $client_id)->value('code_number');
        $client = Client::find(Auth::guard('client')->user()->id);
        return view('clients.DeleteAccount.delete',compact('client'));
    } // END METHOD

    public function ClientDeleteAccountStore(Request $request){
        $client_id = Auth::guard('client')->user()->id;
        $code_number = Client::where('id', $client_id)->value('code_number');
        $client = Client::find(Auth::guard('client')->user()->id);

        $this->validate($request,[
            'email' => 'required',
            'code_number' => 'required',
            'why' => 'required',
            'other' => 'required'
          ]);

          $data = array(
                 'email' => $request->email,
                   'code_number' => $request->code_number,
                    'why' => $request->why,
                    'other' => $request->other
                );
        $user = User::where('id', 1)->first();
        App::setLocale($user->locale);
        Mail::to($user->email)->send(new \App\Mail\DeleteAccount($data));

  return redirect()->Route('Delete.Message');

    } // END METHOD

    public function DeleteMessage(){
        return view('clients.DeleteAccount.delete_m');
    } // END METHOD
	
	

}