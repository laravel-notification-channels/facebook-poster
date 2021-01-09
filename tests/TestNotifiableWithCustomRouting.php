<?php

namespace NotificationChannels\FacebookPoster\Tests;

use Illuminate\Notifications\Notifiable;

class TestNotifiableWithCustomRouting
{
    use Notifiable;

    public function routeNotificationForFacebookPoster(): array
    {
        return [
            'page_id' => 'customPageId',
            'access_token' => 'customAccessToken',
        ];
    }
}
