<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserProfileCreated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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
        $url = url('/');
        
        return (new MailMessage)
                    ->line('Your been granted access to Wazo.')
                    ->line('Wazo is an online Intranet web system designed and developed by WFP Tanzania to facilitate internal communications among the different units and CO and sub offices in the Tanzania')
                    ->line('Meaning “idea” in Swahili, Wazo is a one stop shop for staff in Tanzania to access and share information.')
                    ->line('Through its simplicity, Wazo enables staff to access various services while staying up to date on WFP operations and events in Tanzania.')
                    ->line('Please click below button to log into Wazo')
                    ->action('Login', $url)
                    ->line('To login enter your email address '.$this->user->email.' and WFP Global password');
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
