<?php

namespace NotificationChannels\FacebookPoster;

use GuzzleHttp\Client;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Arr;

class FacebookPosterChannel
{
    /**
     * The Guzzle client.
     */
    protected Client $guzzle;

    /**
     * The application config.
     */
    protected Repository $config;

    /**
     * Create a new channel instance.
     */
    public function __construct(Client $guzzle, Repository $config)
    {
        $this->guzzle = $guzzle;
        $this->config = $config;
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification $notification
     */
    public function send($notifiable, Notification $notification)
    {
        $post = $notification->toFacebookPoster($notifiable);

        $routing = $notifiable->routeNotificationFor('facebookPoster');

        $pageId = Arr::get($routing, 'page_id', function () {
            return $this->config->get('services.facebook_poster.page_id');
        });

        $accessToken = Arr::get($routing, 'access_token', function () {
            return $this->config->get('services.facebook_poster.access_token');
        });

        $this->guzzle->post("https://graph.facebook.com/v9.0/{$pageId}/feed?access_token={$accessToken}", [
            'form_params' => $post->getBody(),
        ]);
    }
}
