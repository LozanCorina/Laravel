<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Invoice extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
                    ->line('Mulțumim pentru comanda efectuată! Vă atașăm factura dvs.')
                    ->line('Comanda a fost preluata. Vă vom contacta pentru confirmarea datelor.')
                    ->action('Accesează pentru mai multe cumpărături', url('/'))
                    ->line('Suntem bucuroși că ați ales serviciul nostru! Vă dorim o dispoziție dulce!')
                    ->attach(storage_path('Invoice_'.auth()->user()->name .'.pdf'),[
                        'as' =>'Invoice_'.auth()->user()->name .'.pdf',
                        'mime' => 'application/pdf'
                    ]);
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
            //
        ];
    }
}
