<?php

namespace NotificationChannels\FacebookPoster;

use Facebook\Facebook;
use Illuminate\Notifications\Notification;
use NotificationChannels\FacebookPoster\Attachments\Video;
use NotificationChannels\FacebookPoster\Exceptions\InvalidPostContent;

class FacebookPosterChannel
{
    /** @var \Facebook\Facebook */
    protected $facebook;

    /**
     * @param \Facebook\Facebook $facebook
     */
    public function __construct(Facebook $facebook)
    {
        $this->facebook = $facebook;
    }

    /**
     * Send the given notification.
     *
     * @param mixed                                  $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @throws InvalidPostContentException
     */
    public function send($notifiable, Notification $notification)
    {
        if ($facebookSettings = $notifiable->routeNotificationFor('facebookPoster')) {
            $this->switchSettings($facebookSettings);
        }

        $facebookMessage = $notification->toFacebookPoster($notifiable);

        $postBody = $facebookMessage->getPostBody();

        $endpoint = $facebookMessage->getApiEndpoint();

        $this->guardAgainstInvalidPostContent($postBody);

        // here we check if post body has image or video to upload it first to facebook
        if (isset($postBody['media'])) {
            $endpoint = $postBody['media']->getApiEndpoint();

            if ($postBody['media'] instanceof Video) {
                $postBody = array_merge($postBody, $postBody['media']->getData());
            }

            $method = $postBody['media']->getMethod();

            $postBody['source'] = $this->facebook->{$method}($postBody['media']->getPath());

            unset($postBody['media']);
        }

        $this->facebook->post($endpoint, $postBody);
    }

    /**
     * @param array $postBody
     *
     * @throws \NotificationChannels\FacebookPoster\Exceptions\InvalidPostContent
     */
    protected function guardAgainstInvalidPostContent($postBody)
    {
        if (! is_null($postBody['message'])) {
            return;
        }

        if (isset($postBody['link'])) {
            return;
        }

        if (isset($postBody['media'])) {
            return;
        }

        throw InvalidPostContent::noContentSet();
    }

    /**
     * Use per user settings instead of default ones.
     * @param $facebookSettings
     */
    private function switchSettings($facebookSettings)
    {
        $this->facebook = new Facebook($facebookSettings);
    }
}
