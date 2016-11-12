<?php

namespace NotificationChannels\FacebookPoster\Attachments;

class Image
{
    /** @var string */
    protected $path;

    /**
     * @var  string
     */
    protected $apiEndpoint;

    /** @var string */
    protected $method = 'fileToUpload';

    /**
     * @param string $imagePath
     * @param string $endpoint
     */
    public function __construct($imagePath,$endpoint)
    {
        $this->path = $imagePath;
        $this->apiEndpoint = $endpoint;
    }

    public function getPath()
    {
        return $this->path;
    }
    
    public function getApiEndpoint()
    {
        return $this->apiEndpoint;
    }

    public function getMethod()
    {
        return $this->method;
    }
}
