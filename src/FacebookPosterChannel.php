<?php

namespace NotificationChannels\FacebookPoster;

use Facebook\Facebook;
use Illuminate\Notifications\Notification;
use NotificationChannels\FacebookPoster\Attaches\Video;
use NotificationChannels\FacebookPoster\Exceptions\InvalidPostContentException;

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
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @throws InvalidPostContentException
     */
    public function send($notifiable, Notification $notification)
    {
        $facebookMessage = $notification->toFacebookPoster($notifiable);

        $postBody = $facebookMessage->getPostBody();

        $endpoint = $facebookMessage->getApiEndpoint();

        if($postBody['message'] == null && (!isset($postBody['link']) && !isset($postBody['media']))){
            throw new InvalidPostContentException("Invalid Post Body Content");
        }

        // here we check if post body has image or video to upload it first to facebook
        if (isset($postBody['media'])) {
        	
            $endpoint = $postBody['media']->getApiEndpoint();

            if($postBody['media'] instanceof Video)
            {
                $postBody = array_merge($postBody,$postBody['media']->getData());
            }
        	
            $method = $postBody['media']->getMethod();

            $postBody['source'] = $this->facebook->{$method}($postBody['media']->getPath());

        	unset($postBody['media']);
        }

        $this->facebook->post($endpoint, $postBody);
    }
}
