<?php

namespace App\Listeners;

use UniSharp\LaravelFilemanager\Events\ImageWasUploaded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Image;

class ResizeUploadedImage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
     {
         $method = 'on'.class_basename($event);
         if (method_exists($this, $method)) {
             call_user_func([$this, $method], $event);
         }
     }
    
    public function onImageWasUploaded(ImageWasUploaded $event)
    {
        $path = $event->path();
        $image = Image::make($path);
        if($image->width() < 725) {
            return;
        }
        // resize the image to a width of 725 and constrain aspect ratio (auto height)
        $image->resize(725, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path);
    }
}
