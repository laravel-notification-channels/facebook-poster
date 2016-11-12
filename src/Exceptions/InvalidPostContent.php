<?php

namespace NotificationChannels\FacebookPoster\Exceptions;

use Exception;

class InvalidPostContent extends Exception
{
    public static function noContentSet()
    {
        return new static('The post must contain either a message, a link or media');
    }
}
