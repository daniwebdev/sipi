<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class Login extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $title   = '';
    private $message = '';
    private $action  = '';
    private $req;

    public function __construct($req, $title="Login")
    {
        $this->title = $title;
        $this->req   = $req;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return ['mail','database'];
        return ['database'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toDatabase() {
        $user_ip = $this->req->ip();
        $user    = Auth::user();
        $image   = isset($user->get_avatar->url) ? $user->get_avatar->url:'';
        $geo     = '';
        try {
            $client = new Client();
            $get  = $client->get("http://ip-api.com/json/".$user_ip)->getBody();
            $json = json_decode($get);
            $geo  = $json->city;
        } catch (\Throwable $th) {

        }
        return [
            "title" => 'New login at '.gmdate('d M Y H:i:s'),
            "message" => "New login from ".$geo." ($user_ip)",
            "action" => "",
            "image" => $image,
        ];
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
