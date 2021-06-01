<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;

class Invoice extends Mailable
{
    use Queueable, SerializesModels;
       public $data;
       public $data1;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$data1)
    {
        $this->data=$data;
        $this->data1=$data1;
    
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('infoDolceVita@gmail.com')    
        ->subject('Factură DolceVita')  
        ->view('emails.invoice')    
        ->with(['data'=>$this->data,'data1'=>$this->data1])
        ->attach(storage_path('Invoice_'.auth()->user()->name .'.pdf'),[
            'as' =>'Invoice_'.auth()->user()->name .'.pdf',
            'mime' => 'application/pdf'
        ]);
    }
}
