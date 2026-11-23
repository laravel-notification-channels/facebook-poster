<?php

namespace NotificationChannels\FacebookPoster\Tests;

use Illuminate\Notifications\Notification;
use NotificationChannels\FacebookPoster\FacebookPosterImage;

class TestNotificationWithImage extends Notification
{
    public function toFacebookPoster($notifiable)
    {
        return new FacebookPosterImage('https://example.com/image.jpg', 'caption');
    }
}
