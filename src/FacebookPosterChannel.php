<?php

namespace NotificationChannels\FacebookPoster;

use Facebook\Facebook;
use Illuminate\Notifications\Notification;

class FacebookPosterChannel
{
    /**
     * The Facebook client.
     *
     * @var \Facebook\Facebook
     */
    protected $facebook;

    /**
     * Create a new channel instance.
     *
     * @param  \Facebook\Facebook  $facebook
     */
    public function __construct(Facebook $facebook)
    {
        $this->facebook = $facebook;
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

        $body = $post->getBody();

        if ($media = $post->getMedia()) {
            $body['source'] = $this->facebook->{$media::API_METHOD}($media->getPath());
        }

        $this->facebook->post($post->getEndpoint(), $body);
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
