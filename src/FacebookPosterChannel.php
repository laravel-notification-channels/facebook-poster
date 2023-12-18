<?php

namespace NotificationChannels\FacebookPoster;

use GuzzleHttp\Client;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Arr;

class FacebookPosterChannel
{
    /**
     * Create a new channel instance.
     */
    public function __construct(protected Client $guzzle, protected Repository $config)
    {
        //
    }

    /**
     * Send the given notification.
     */
    public function send(mixed $notifiable, Notification $notification): void
    {
        $post = $notification->toFacebookPoster($notifiable);

        $routing = $notifiable->routeNotificationFor('facebookPoster');

        $pageId = Arr::get($routing, 'page_id', function () {
            return $this->config->get('services.facebook_poster.page_id');
        });

        $accessToken = Arr::get($routing, 'access_token', function () {
            return $this->config->get('services.facebook_poster.access_token');
        });

        $this->guzzle->post("https://graph.facebook.com/v18.0/{$pageId}/feed?access_token={$accessToken}", [
            'form_params' => $post->getBody(),
        ]);
    }
}
