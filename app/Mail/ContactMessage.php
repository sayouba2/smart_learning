<?php
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $fromEmail;

    public function __construct($data, $fromEmail)
    {
        $this->data = $data;
        $this->fromEmail = $fromEmail;
    }

    public function build()
    {
        return $this->from($this->fromEmail)
                    ->subject('Nouveau message de contact')
                    ->view('emails.contact'); // ta vue d'email
    }
}
