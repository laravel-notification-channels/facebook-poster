<?php

namespace NotificationChannels\FacebookPoster\Tests;

use Illuminate\Notifications\Notification;
use NotificationChannels\FacebookPoster\FacebookPosterPost;

class TestNotificationWithLink extends Notification
{
    public function toFacebookPoster($notifiable)
    {
        return (new FacebookPosterPost('message'))
            ->withLink('http://laravel.com');
    }
}
