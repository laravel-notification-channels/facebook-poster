<?php

namespace NotificationChannels\FacebookPoster\Test;

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