<?php

namespace App\Notifications;

use App\VenueBooking;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Jenssegers\Date\Date;

class ConferenceRoomBookingAmended extends Notification
{
    use Queueable;

    protected $booking;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(VenueBooking $booking){
        $this->booking = $booking;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable){
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable){
        $date = new Date($this->booking->date);
        $date = $date->format('l jS F, Y');

        $start_time = new Date($this->booking->start_time);
        $start_time = $start_time->format('h:i A');

        $end_time = new Date($this->booking->end_time);
        $end_time = $end_time->format('h:i A');

        $url = url('/conferencebooking/'.$this->booking->id);

        return (new MailMessage)
                    ->line('Conference Booking has been amended')
                    ->line('Venue: '.$this->booking->venue)
                    ->line('Purpose: '.$this->booking->purpose)
                    ->line('Date: '.$date)
                    ->line('Time frame: '.$start_time.' to '.$end_time)
                    ->line('Number of paticipants: '.$this->booking->participants)
                    ->line('Reserved by: '.User::find($this->booking->created_by)->firstname.' '.User::find($this->booking->created_by)->secondname)
                    ->line('Click on the buton below to access full booking details')
                    ->action('Booking Details', $url)
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
