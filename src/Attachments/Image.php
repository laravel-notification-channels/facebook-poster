<?php

namespace NotificationChannels\FacebookPoster\Attachments;

class Image extends Attachment
{
    /**
     * The image API method.
     *
     * @var string
     */
    protected $apiMethod = 'fileToUpload';

    /**
     * Create a new image instance.
     *
     * @param  string  $path
     * @param  string  $endpoint
     */
    public function __construct($path, $apiEndpoint)
    {
        $this->path = $path;
        $this->apiEndpoint = $apiEndpoint;
    }
}
