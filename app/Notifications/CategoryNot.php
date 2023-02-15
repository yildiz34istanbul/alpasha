<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CategoryNot extends Notification
{
    use Queueable;



    protected $tracking_number;
    protected $code_number;


    public function __construct($tracking_number,$code_number)
    {

        $this->tracking_number = $tracking_number;
        $this->code_number = $code_number;



    }


    public function via($notifiable)
    {
        return ['database'];
    }


    public function toArray($notifiable)
    {
        return [

            'data'=> __("track.add_new_track_number") ." "."<span class='badge badge-info'>$this->tracking_number</span>".' التابعة لـ '. ' '."<span class='badge badge-dark'>$this->code_number</span>". '<br> ',

        ];
    }


}
