<?php

namespace NotificationChannels\FacebookPoster\Attachments;

abstract class Attachment
{
    /**
     * The attachment path.
     *
     * @var string
     */
    protected $path;

    /**
     * Create a new attachment instance.
     *
     * @param  string  $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Get the attachment path.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
}
