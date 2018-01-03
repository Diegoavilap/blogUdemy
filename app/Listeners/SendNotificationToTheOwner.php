<?php

namespace App\Listeners;

use Mail;
use App\Events\MessageWasReceived;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotificationToTheOwner
{
    
    /**
     * Handle the event.
     *
     * @param  MessageWasReceived  $event
     * @return void
     */
    public function handle(MessageWasReceived $event)
    {
       
        $message = $event->message;
        Mail::send('emails.contact',['msg'=>$message], function($m) use ($message){
            //Con la funcion to se especifica el email y el nombre a quien va dirijido el email
            //Con la funcion subject se define el asunto
            $m->from($message->email, $message->nombre)
                ->to('diegoavilapava@hotmail.com','Diego')
                ->subject('Tu mensaje fue recibido');
        });
    }
}
