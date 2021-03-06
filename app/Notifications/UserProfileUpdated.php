<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserProfileUpdated extends Notification
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
        $url = url('/feedback');
        
        return (new MailMessage)
                    ->line('Your user profile has been updated.')
                    ->line('Account name: '.$this->user->firstname.' '.$this->user->secondname)
                    ->line('Username: '.$this->user->username)
                    ->line('Title: '.$this->user->title)
                    ->line('Email: '.$this->user->email)
                    ->line('Country: '.$this->user->country)
                    ->line('Region: '.$this->user->region)
                    ->line('NTE: '.$this->user->nte)
                    ->line('Please click on below button and provide your feedback on how we can further improve Wazo')
                    ->action('Send us your Feedback', $url)
                    ->line('Thank you for using Wazo!');
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
