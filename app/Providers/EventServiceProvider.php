<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use UniSharp\LaravelFilemanager\Events\ImageWasUploaded;
use \App\Listeners\ResizeUploadedImage;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            // add your listeners (aka providers) here
            'SocialiteProviders\\Azure\\AzureExtendSocialite@handle',
        ],
        ImageWasUploaded::class => [
            ResizeUploadedImage::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
