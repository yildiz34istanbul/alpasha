<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */




    public function index()
    {
        $users = User::all();

        return view('users.add-user',compact('users'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {



        try {


$validated = $request->validate([
    'email' => 'required|unique:users',
    'name' => 'required|max:25',


],

[
    // custom maseges
    'email' => 'unique',
    'name' => 'max 25 chr',

]);


            // insert data with method
           User::insert([

                'name'=> $request->name,
                'password'=> bcrypt($request->password),
               'email'=> $request->email,
               'is_admin'=>$request->is_admin,
               'locale'=>$request->locale,
                'created_at'=>Carbon::now(),

            ]);


             // insert data with BD
          // $data= array();
          // $data['name'] = $request->name;
          // $data['password'] = bcrypt($request->password);
           //$data['email'] = $request->email;
         // $data['usertype'] = $request->usertype;
        // $data['locale'] = $request->locale;

          // DB::table('users')->insert($data);
       // $user = User::all();
              //  Notification::send($user, new tracknotification($request->tracking_number,$request->tacking_status));


            return Redirect()->back()->with('success','تم اضافة  بنجاح ');

        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

        }









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
        $users = User::find($id);

        return view('user.edit', compact('users'));
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

        try {
            $update = User::find($id);


            $update->name = $request->name;
            $update->password = bcrypt($request->password);
            $update->email = $request->email;
            $update->is_admin = $request->is_admin;
            $update->locale = $request->locale;
            $update->updated_at=Carbon::now();
           $update->save();


       return Redirect()->route('all.user')->with('success','تم تحديث  بنجاح ');

   }
   catch
   (\Exception $e) {
       return redirect()->back()->withErrors(['error' => $e->getMessage()]);
   }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


    }

    public function Delete($id){

        $delete = User::find($id)->Delete();

        return Redirect()->back()->with('success','تم حذف  بنجاح ');

     }





     public function ClientIndexShow()
     {
         $clients = Client::all();

         return view('client_index',compact('clients'));
     }



}
