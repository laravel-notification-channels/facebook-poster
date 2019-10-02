<?php

namespace NotificationChannels\FacebookPoster\Tests;

class TestNotifiable
{
    use \Illuminate\Notifications\Notifiable;

    /**
     * @return int
     */
    public function routeNotificationForFacebookPoster()
    {
        return false;
    }
}
