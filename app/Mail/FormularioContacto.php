<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class FormularioContacto extends Mailable
{
    use Queueable, SerializesModels;


    private $request;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // instead we could use:
        // return $this->from('myemailaddress@gmail.com')->view('view_name');
        return $this->view('emails.contacto')->with(['request' => $this->request]);
    }
}
