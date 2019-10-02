<?php

namespace NotificationChannels\FacebookPoster\Tests;

use Illuminate\Notifications\Notification;
use NotificationChannels\FacebookPoster\FacebookPosterPost;

class TestNotificationWithImage extends Notification
{
    public function toFacebookPoster($notifiable)
    {
        return (new FacebookPosterPost('message'))
            ->withImage('image1.png');
    }
}
