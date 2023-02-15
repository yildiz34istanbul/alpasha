<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Tracking;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Countrys= Country::all();

        return view('admin.countries.country',compact('Countrys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function storeCountry(Request $request)
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
    $Country = new Country();
    $Country->Country_Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar,'tr'=> $request->Name_tr];
    $Country->save();

    return redirect()->route('all.country');
}

catch (\Exception $e){
    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroyCountry(Request $request,$id)
    {

        $tracking_id = Tracking::where('country_id',$request->id)->pluck('country_id');

        if($tracking_id->count()== 0){


            $delete = Country::find($id)->Delete();

            return Redirect()->back()->with('success',"تم الحذف بنجاح  ");
        }else{

            return Redirect()->back()->with('error',"لا يمكن الحذف بسبب وجود شحنات تابعة للدولة ");
        }

    }




  public function testcount(){

  //$country = Country::with('track_conutry')->find(2);
  //$country = Country::find(3);
  //return $country->track_conutry;
  //return $country->track_conutry;

  //$track = $country->track_conutry;

  // foreach ($track as $trackg){
   //   echo  $trackg -> tracking_number.'<br>';
  // }

  //return Country::whereHas('track_conutry')->get();

  ///return Country::whereDoesntHave('track_conutry')->get();
  return Country::whereHas('track_conutry', function ($q) {
    $q->where('code_number', '888');
})->get();

  }



}
