<?php

namespace NotificationChannels\FacebookPoster\Test;

use Illuminate\Notifications\Notification;
use NotificationChannels\FacebookPoster\FacebookPosterPost;

class TestNotificationWithVideo extends Notification
{

    public function toFacebookPoster($notifiable)
    {
        return (new FacebookPosterPost('Laravel Notification Channels are awesome!'))
            ->withVideo('video1.mp4',['title' => 'laravel' , 'description' => 'laravel framework.']);
    }
}