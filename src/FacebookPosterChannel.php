<?php

namespace NotificationChannels\FacebookPoster;

use GuzzleHttp\Client;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Notifications\Notification;

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
        if ($facebookSettings = $notifiable->routeNotificationFor('facebookPoster')) {
            $this->switchSettings($facebookSettings);
        }

        $post = $notification->toFacebookPoster($notifiable);

        $pageId = $this->config->get('services.facebook_poster.page_id');
        $accessToken = $this->config->get('services.facebook_poster.access_token');

        $this->guzzle->post(
            "https://graph.facebook.com/v9.0/{$pageId}/feed?access_token={$accessToken}",
            $post->getBody(),
        );
    }

    /**
     * Use per user settings instead of default ones.
     *
     * @param  array  $config
     * @return void
     */
    protected function switchSettings(array $config)
    {
        $this->facebook = new Facebook($config);
    }
}
