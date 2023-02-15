<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tracking;
use App\Models\ClientInvoices;
use Auth;
use Response;
use File;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class InvoicesController extends Controller
{

    public function AddInvoices($id)
    {


        $tracking = Tracking::find($id);
        $ClientInvoices = ClientInvoices::where('tracking_id', $tracking->tracking_number)->get();
       // return $ClientInvoices;
        return view('tracking.add-invoices',compact('tracking','ClientInvoices'));
    }




    public function InvoicesStore(Request $request , $id)
    {

        try {

        $Tracking_id = Tracking::find($id);

                ClientInvoices::create([
                    'tracking_id' => $Tracking_id->tracking_number,
                    'code_number'=> $Tracking_id->code_number,
                    'invoice'=> $request->name,
                    'url'=> $request->invoice,
                    'user' => (Auth::user()->name),
                ]);
       // DB::commit(); // insert data
        return Redirect()->back()->with('success', __("تم اضافة مرفقات الفواتير بنجاح") );

    }

    catch (\Exception $e){
      //  DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

    }



    public function Download_Invoices()
    {

    }


    public function Delete_Invoices(Request $request)
    {
        // Delete img in server disk
        File::delete(public_path('../../upload/invoices/'.$request->tracking_id.'/'.$request->filename));

        // Delete in data
        ClientInvoices::where('id',$request->Invoice_id)->delete();
        return Redirect()->back()->with('success', __("تم الحذف  بنجاح") );
    }



    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
