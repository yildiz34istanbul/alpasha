<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Queue\SerializesModels;

class NotificationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    protected $tracking_number;
    protected $tacking_status_id;
    public $id=0;
    public $message,$user_id;
    public $n_type;

    public function __construct($message,$type,$user_id,$tracking_number,$tacking_status_id)
    {
        $this->message = $message;
        $this->user_id = $user_id;
        $this->n_type = $type;
        $this->tracking_number = $tracking_number;
        $this->tacking_status_id = $tacking_status_id;
    }

    public function toArray($notifiable)
    {
        if ($this->tacking_status_id == 1){

            return [

                'data'=> __("track.Update track number") ." "."<span class='badge badge-info'>$this->tracking_number</span>".' الى '. ' '. __("track.track_1"). '<br> ',

            ];
        }elseif($this->tacking_status_id == 2){
            return [

                'data'=> __("track.Update track number") ." "."<span class='badge badge-info'>$this->tracking_number</span>".' الى '. ' '. __("track.track_2"). '<br> ' ,

            ];

        }

        elseif($this->tacking_status_id == 3){
            return [

                'data'=> __("track.Update track number") ." "."<span class='badge badge-info'>$this->tracking_number</span>".' الى '. ' '. __("track.track_3"). '<br> ' ,

            ];

        }

        elseif($this->tacking_status_id == 4){
            return [

                'data'=> __("track.Update track number") ." "."<span class='badge badge-info'>$this->tracking_number</span>".' الى '. ' '. __("track.track_4"). '<br> ' ,

            ];

        }
        elseif($this->tacking_status_id == 5){
            return [

                'data'=> __("track.Update track number") ." "."<span class='badge badge-info'>$this->tracking_number</span>".' الى '. ' '. __("track.track_5"). '<br> ' ,

            ];

        }

        elseif($this->tacking_status_id == 6){
            return [

                'data'=> __("track.Update track number") ." "."<span class='badge badge-info'>$this->tracking_number</span>".' الى '. ' '. __("track.track_6"). '<br> ' ,

            ];

        }
        elseif($this->tacking_status_id == 7){
            return [

                'data'=> __("track.Update track number") ." "."<span class='badge badge-info'>$this->tracking_number</span>".' الى '. ' '. __("track.track_7"). '<br> ',

            ];

        }
        
         elseif($this->tacking_status_id == 8){
            return [

              'data'=> __("track.Update track number") ." "."<span class='badge badge-info'>$this->tracking_number</span>".' الى '. ' '. __("track.track_8"). '<br> ',

            ];

        }

    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('albasha-turkey-75');
    }
    public function broadcastAs()
    {
        return 'my-notify';
    }
    public function tobroadcast($notifiable)
    {
        return new BroadcastMessage([

            'data'=> __("track.Update track number") ." "."<span class='badge bg-primary'>$this->tracking_number</span>".__("track.to status").  __("track.with") . auth()->user()->name ,

        ]);
    }
    public function via($notifiable)
    {
        return ['broadcast'];
    }
}
