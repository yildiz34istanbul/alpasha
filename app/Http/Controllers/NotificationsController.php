<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Notification;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }




    public function All(){

        $notifications = Auth::user()->Notifications();

        return view('admin.notifications.notifications',compact('notifications'));
    }

    public function Read_Notification(){

        $read_notifications = Auth::user()->readNotifications();

        return view('admin.notifications.read-notifications',compact('read_notifications'));
    }







    public function MarkAsRead_all (Request $request)
    {

        $userUnreadNotification= auth()->user()->unreadNotifications;

        if($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return back();
        }


    }


    /* Client */

    public function ClientNotificationsAll(){

        $clients_notifications = Auth::guard('client')->user()->Notifications();

        return view('clients.notifications.notifications',compact('clients_notifications'));
    }


    public function Client_Read_Notification(){

        $client_read_notifications = Auth::guard('client')->user()->readNotifications();

        return view('clients.notifications.read-notifications',compact('client_read_notifications'));
    }


     public function ClientMarkAsRead_all (Request $request)
    {

        $userUnreadNotification= Auth::guard('client')->user()->unreadNotifications;

        if($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return back();
        }


    }



}


