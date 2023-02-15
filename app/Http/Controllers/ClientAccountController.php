<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\ClientAccount;
use App\Models\Payment;
use App\Imports\PaymentsImport;
use App\Imports\Payments;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class ClientAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function ClientAccountShow()
    {
        $clients = Client::all();
        $clientAccount = ClientAccount::all();
       // $client_id = ClientAccount::where('client_id',$id)->get();

        return view('admin.clients.account',compact('clients','clientAccount'));
    }

    public function AccountShow($id)
    {
        $client = Client::find($id);
        //$clientAccount = ClientAccount::all();
        $client_id = ClientAccount::where('client_id',$id)->get();

        return view('admin.clients.show-account',compact('client','client_id'));
    }



    public function AccountAdd(Request $request , $id)
    {

        $clients = Client::all();
        $clientAccount = ClientAccount::all();
        $client_id = ClientAccount::where('client_id',$id)->get();

        ClientAccount::create([
            'client_id' => $id,
            'Debit'=> $request->Debit,
            'credit'=> 0.00,
            'created_at'=>Carbon::now()


       ]);
       return redirect()->back()->with('success', __("تم اضافة رصيد جديد الى حساب العميل "));
      // return view('admin.clients.account',compact('clients','clientAccount'));

    }


    public function ClientPaymentShow()
    {
        $clients = Client::all();
        $clientAccount = ClientAccount::all();


        return view('admin.clients.payment',compact('clients','clientAccount'));
    }


    public function ClientPaymentAdd(Request $request , $id)
    {

        $clients = Client::all();
        $clientAccount = ClientAccount::all();
        $client_id = ClientAccount::where('client_id',$id)->get();


        Excel::import(new PaymentsImport, $request->file);

       return view('admin.clients.payment',compact('clients','clientAccount'));

    }

    public function PaymentShow($id)
    {

        $client = Client::find($id);
       // $clientAccount = ClientAccount::all();
       // $payment = Payment::where('client_id',$id)->get();
        $Account_Debit = ClientAccount::where('client_id',$id)->sum('Debit');
        $Account_credit = ClientAccount::where('client_id',$id)->sum('credit');
       // $payment_cunt = Payment::where('client_id',$id)->sum('amount');
  // return $Account_credit;
       return view('admin.clients.show-payment',compact('Account_Debit','Account_credit','client'));
    }





}
