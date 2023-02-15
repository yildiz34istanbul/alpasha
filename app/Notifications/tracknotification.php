<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class tracknotification extends Notification implements ShouldBroadcast
{
    use Queueable;


    protected $tracking_number;
    protected $tacking_status_id;
     protected $code_number;


    public function __construct($tracking_number,$tacking_status_id,$code_number)
    {

        $this->tracking_number = $tracking_number;
        $this->tacking_status_id = $tacking_status_id;
         $this->code_number = $code_number;

    }


    public function via($notifiable)
    {
        return ['database','broadcast'];
    }


      public function toArray($notifiable)
    {
        if ($this->tacking_status_id == 1){

       return [

            'data'=> __("track.Update track number") ." "."<span class='badge badge-info'>$this->tracking_number</span>".' الى '. ' '. __("track.track_1"). ' التابعة لـ '. ' '."<span class='badge badge-dark'>$this->code_number</span>". '<br> ',

        ];
    }elseif($this->tacking_status_id == 2){
        return [

            'data'=> __("track.Update track number") ." "."<span class='badge badge-info'>$this->tracking_number</span>".' الى '. ' '. __("track.track_2"). ' التابعة لـ '. ' '."<span class='badge badge-dark'>$this->code_number</span>". '<br> ' ,

        ];

    }

elseif($this->tacking_status_id == 3){
    return [

        'data'=> __("track.Update track number") ." "."<span class='badge badge-info'>$this->tracking_number</span>".' الى '. ' '. __("track.track_3"). ' التابعة لـ '. ' '."<span class='badge badge-dark'>$this->code_number</span>". '<br> ' ,

    ];

}

elseif($this->tacking_status_id == 4){
    return [

        'data'=> __("track.Update track number") ." "."<span class='badge badge-info'>$this->tracking_number</span>".' الى '. ' '. __("track.track_4"). ' التابعة لـ '. ' '."<span class='badge badge-dark'>$this->code_number</span>". '<br> ' ,

    ];

}
elseif($this->tacking_status_id == 5){
    return [

        'data'=> __("track.Update track number") ." "."<span class='badge badge-info'>$this->tracking_number</span>".' الى '. ' '. __("track.track_5"). ' التابعة لـ '. ' '."<span class='badge badge-dark'>$this->code_number</span>". '<br> ' ,

    ];

}

elseif($this->tacking_status_id == 6){
    return [

        'data'=> __("track.Update track number") ." "."<span class='badge badge-info'>$this->tracking_number</span>".' الى '. ' '. __("track.track_6"). ' التابعة لـ '. ' '."<span class='badge badge-dark'>$this->code_number</span>". '<br> ' ,

    ];

}
elseif($this->tacking_status_id == 7){
    return [

        'data'=> __("track.Update track number") ." "."<span class='badge badge-info'>$this->tracking_number</span>".' الى '. ' '. __("track.track_7"). ' التابعة لـ '. ' '."<span class='badge badge-dark'>$this->code_number</span>". '<br> ',

    ];



}
elseif($this->tacking_status_id == 8){
    return [

        'data'=> __("track.Update track number") ." "."<span class='badge badge-info'>$this->tracking_number</span>".' الى '. ' '. __("track.track_8"). ' التابعة لـ '. ' '."<span class='badge badge-dark'>$this->code_number</span>". '<br> ',

    ];
}

    }

    public function tobroadcast($notifiable)
    {
        return new BroadcastMessage([

            'data'=> __("track.Update track number") ." "."<span class='badge bg-primary'>$this->tracking_number</span>".__("track.to status").  __("track.with") . auth()->user()->name ,

        ]);
    }



    public function broadcastOn()
    {
        return ['alpasha'];
    }

}
