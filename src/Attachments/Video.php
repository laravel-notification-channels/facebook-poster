<?php

namespace NotificationChannels\FacebookPoster\Attachments;

class Video
{
    /** @var array */
    private $data = [];

    /** @var string */
    private $path;
    
    /** @var string */
    private $method = 'videoToUpload';

    /**
     * @var  string
     */
    private $apiEndpoint;

    public function __construct($videoPath,$endpoint)
    {
        $this->path        = $videoPath;
        $this->apiEndpoint = $endpoint;
    }

    public function setTitle($title)
    {
        $this->data['title'] = $title;
        return $this;
    }

    public function setDescription($description)
    {
        $this->data['description'] = $description;
        return $this;
    }

    public function getData()
    {
        return $this->data;
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
