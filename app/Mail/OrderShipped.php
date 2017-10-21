<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        /*return $this->markdown('emails.orders.shipped')
                ->with([
                        'url' => 'google.com/prueba',
                    ]);*/
        $address = 'david.calderon@infotegra.com';
        $name = 'Ignore Me';
        $subject = 'Krytonite Found';

        return $this->markdown('emails.orders.shipped')
                ->from($address, $name)
                ->cc($address, $name)
                ->bcc($address, $name)
                ->replyTo($address, $name)
                ->subject($subject)
                ->with([
                        'url' => 'google.com/prueba',
                    ]);
    }
}
