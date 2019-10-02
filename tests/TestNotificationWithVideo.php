<?php

namespace NotificationChannels\FacebookPoster\Tests;

use Illuminate\Notifications\Notification;
use NotificationChannels\FacebookPoster\FacebookPosterPost;

class TestNotificationWithVideo extends Notification
{
    public function toFacebookPoster($notifiable)
    {
        return (new FacebookPosterPost('message'))
            ->withVideo('video1.mp4', 'title', 'description');
    }
}
