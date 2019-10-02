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

        $facebookMessage = $notification->toFacebookPoster($notifiable);

        $postBody = $facebookMessage->getPostBody();

        $endpoint = $facebookMessage->getApiEndpoint();

        if (isset($postBody['media'])) {
            $endpoint = $postBody['media']->getApiEndpoint();

            $postBody = array_merge($postBody, $postBody['media']->getData());

            $method = $postBody['media']->getApiMethod();

            $postBody['source'] = $this->facebook->{$method}($postBody['media']->getPath());

            unset($postBody['media']);
        }

        $this->facebook->post($endpoint, $postBody);
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
