<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

use App\Models\Messagelog;
class NotifiMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $text;
    public $subject;
    public function __construct($text,$subject="مجموعه الباشا الدولية")
    {
        $this->text=$text;
        $this->subject=$subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $ret= $this->from('system@alpashagroup.com', 'مجموعه الباشا الدولية')
            ->subject($this->subject)
            ->view('mail.notifi',['text'=>$this->text]);
            return $ret;
    }
}
