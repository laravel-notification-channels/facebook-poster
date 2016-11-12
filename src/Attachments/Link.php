<?php

namespace NotificationChannels\FacebookPoster\Attachments;

class Link
{
    /** @var string */
    private $url;

    public function __construct($link)
    {
        $this->url = $link;
    }
    public function getUrl()
    {
        return $this->url;
    }
}
