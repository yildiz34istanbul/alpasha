<?php

namespace App\Http\Controllers;

use App\Models\TrackingType;
use App\Models\Tracking;
use App\Models\TrackingReport;
use Illuminate\Http\Request;
use PDF;

class TrackingTypeController extends Controller
{



    public function index()
    {
        $TrackingTypes = TrackingType::all();

        return view('admin.tracking-type.track-type',compact('TrackingTypes'));
    }




    public function storeTrackingType(Request $request)
    {

 try {

    $validated = $request->validate([
        'Name_ar' => 'required',
        'Name_en' => 'required',
        'Name_tr' => 'required',


    ],

    [
        // custom maseges
        'Name_en.required' => __('track.pless_input'),

    ]);
    $TrackingType = new TrackingType();
    $TrackingType->tracking_type_name = ['en' => $request->Name_en, 'ar' => $request->Name_ar,'tr'=> $request->Name_tr];
    $TrackingType->save();

    return redirect()->route('all.TrackingType');
}

catch (\Exception $e){
    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
}
    }





    public function destroyTrackingType(Request $request,$id)
    {

        $tracking_id = Tracking::where('type_tracking_id',$request->id)->pluck('type_tracking_id');

        if($tracking_id->count()== 0){


            $delete = TrackingType::find($id)->Delete();

            return Redirect()->back()->with('success',"تم الحذف بنجاح  ");
        }else{

            return Redirect()->back()->with('error',"لا يمكن الحذف بسبب وجود شحنات تابعة  ");
        }

    }



    public function destroy(TrackingType $trackingType)
    {




    }
}
