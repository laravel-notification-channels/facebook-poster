<?php

namespace NotificationChannels\FacebookPoster\Test;

use Illuminate\Notifications\Notification;
use NotificationChannels\FacebookPoster\FacebookPosterPost;

class TestNotificationWithLink extends Notification
{

    public function toFacebookPoster($notifiable)
    {
        return (new FacebookPosterPost('Laravel Notification Channels are awesome!'))
            ->withLink('http://laravel.com');
    }
}