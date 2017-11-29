<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MessageSent extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    protected $message;
    
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
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
                    //sobreescribir el saludo
                    ->greeting($notifiable->name . ",")
                    //agregar asunto
                    ->subject('Mensaje recibido desde tu sitio web')
                    //texto que ira en el correo electronico
                    ->line('The introduction to the notification.')
                    //boton de llamado a la accion
                    ->action('Click aqui para ver el mensaje', route('messages.show', $this->message->id))
                    //
                    ->line('Gracias por usar nuestra aplicacion');

        //para crear nuestra propia vista de emails
        //return (new MailMessage)->view('emails.notification',[
            //'msg'=> $this->message
            //'user' => $notifiable
            //])->subject('Mensaje recibido desde tu sitio web');

        //utilizar mailables
        //return (new CustomMail($message))->to($notifiable->email);
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

            'link' => route('messages.show', $this->message->id),
            'text' => "has recibido el mensaje de " . $this->message->sender->name

        ];
    }
}
