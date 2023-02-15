<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{




    public function ProfileView(){
    	$id = Auth::user()->id;
    	$user = User::find($id);

    	return view('users.view_profile',compact('user'));
    }

    public function ProfileEdit(){
    	$id = Auth::user()->id;
    	$user = User::find($id);
    	return view('users.edit_profile',compact('user'));
    }




    public function ProfileStore(Request $request){



    	$data = User::find(Auth::user()->id);
    	$data->name = $request->name;
    	$data->email = $request->email;
        $data->locale = $request->locale;
       // $data->password = bcrypt($request->password);


    	if ($request->file('image')) {
    		$file = $request->file('image');
    		@unlink(public_path('../../upload/user_images/'.$data->image));
    		$filename = date('YmdHi').$file->getClientOriginalName();
    		$file->move(public_path('../../upload/user_images'),$filename);
    		$data['profile_photo_path'] = $filename;
    	}







    	$data->save();

    	//$notification = array(
    	//	'message' => 'User Profile Updated Successfully',
    	//	'alert-type' => 'success'
    //	);

    	return redirect()->route('ProfileView');

    } // End Method




    public function PasswordView(){

        $id = Auth::user()->id;
    	$user = User::find($id);

    	return view('users.update-password',compact('user'));



    }


    public function PasswordUpdate(Request $request){

        $validated = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',


        ]);
        $haspassword = Auth::user()->password;
        if(Hash::check($request->oldpassword,$haspassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login');
        }else{
            return redirect()->back()->with('errors', __("track.error password") );

        }



    }




    }




