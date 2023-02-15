<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DeleteAccount extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;

    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this->subject(__("track.request_delete_account"))
            ->from('system@alpashagroup.com','Alpasha Group')
        ->markdown('mail.DeleteAccount',['data'=>$this->data]);
    }


   // public function build()
   // {
    //    return $this->markdown('mail.DeleteAccount');
   // }
}
