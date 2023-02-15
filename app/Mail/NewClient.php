<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewClient extends Mailable
{
    use Queueable, SerializesModels;

    public $name,$c_number;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$c_number)
    {
        $this->name = $name;
        $this->c_number = $c_number;

    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(__("track.New_customer_registered"))
            ->from('system@alpashagroup.com','Alpasha Group')
        ->markdown('mail.NewClient',['c_number'=>$this->c_number,'name'=>$this->name]);
    }
   // public function build()
   // {
   //     return $this->markdown('mail.NewClient');
  //  }
}
