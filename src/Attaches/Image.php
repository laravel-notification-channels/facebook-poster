<?php

namespace NotificationChannels\FacebookPoster\Attaches;

class Image
{
    /** @var string */
    private $path;

    /**
     * @var  string
     */
    private $apiEndpoint;

    /** @var string */
    private $method = 'fileToUpload';

    public function __construct($imagePath,$endpoint)
    {
        $this->path        = $imagePath;
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
