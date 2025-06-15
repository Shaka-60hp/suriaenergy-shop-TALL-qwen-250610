<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $cart;
    public $data;
    public $isAdmin;

    public function __construct($order, $cart, $data, $isAdmin = false)
    {
        $this->order = $order;
        $this->cart = $cart;
        $this->data = $data;
        $this->isAdmin = $isAdmin;
    }

    public function build()
    {
        $subject = $this->isAdmin ? 'Nuevo pedido recibido' : 'Tu pedido ha sido generado';

        return $this->from('no-reply@suriaenergy.com')
            ->to($this->data['email'])
            ->subject($subject)
            ->view('emails.order-placed');
    }
}
