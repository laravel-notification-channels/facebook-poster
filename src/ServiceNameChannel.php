<?php

namespace NotificationChannels\FacebookPoster;

use NotificationChannels\FacebookPoster\Exceptions\CouldNotSendNotification;
use NotificationChannels\FacebookPoster\Events\MessageWasSent;
use NotificationChannels\FacebookPoster\Events\SendingMessage;
use Illuminate\Notifications\Notification;

class FacebookPostChannel
{
    public function __construct()
    {
        // Initialisation code here
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @throws \NotificationChannels\FacebookPoster\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        //$response = [a call to the api of your notification send]

//        if ($response->error) { // replace this by the code need to check for errors
//            throw CouldNotSendNotification::serviceRespondedWithAnError($response);
//        }
    }
}
