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
                    ->line('NTE: '.$this->user->nte)
                    ->line('Title: '.$this->user->title)
                    ->line('Country: '.$this->user->country)
                    ->line('Region: '.$this->user->region)
                    ->line('Please provide your feedback on how we can improve Wazo by clicking on below button')
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
