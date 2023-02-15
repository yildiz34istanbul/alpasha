<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name,$t_number,$t_status,$s_id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$t_number,$t_status,$s_id)
    {
        $this->name = $name;
        $this->t_number = $t_number;
        $this->t_status = $t_status;
        $this->s_id = $s_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(__("track.tracking update successfully"))
            ->from('system@alpashagroup.com','Alpasha Group')
        ->markdown('mail.welcome',['number'=>$this->t_number,'status'=>$this->t_status,'id'=>$this->s_id]);
    }

}
