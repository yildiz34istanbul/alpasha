<?php

namespace App\Notifications;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
class ClientNotify extends Notification
{
    use Queueable, Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $text,$n_type,$user_id;
    public function __construct($text,$type,$user_id)
    {
        $this->text=$text;
        $this->n_type=$type;
        $this->user_id=$user_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast','mail'];
    }




    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'data'=>$this->text
        ];
    }
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("مجموعه الباشا الدوليه اشعار جديد")
                    ->line($this->text);
    }
    public function tobroadcast($notifiable)
    {
        return new BroadcastMessage([

            'message'=>$this->text,
            'n_type'=>$this->n_type,
            'user_id'=>$this->user_id,

        ]);
    }
    public function broadcastOn()
    {
        return new Channel('albasha-turkey-75');
    }
    public function broadcastAs()
    {
        return 'my-notify';
    }

}
