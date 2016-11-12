<?php

namespace NotificationChannels\FacebookPoster\Attachments;

class Video
{
    /** @var array */
    protected $data = [];

    /** @var string */
    protected $path;

    /** @var string */
    protected $method = 'videoToUpload';

    /** @var string */
    protected $apiEndpoint;

    /**
     * @param string $videoPath
     * @param string $endpoint
     */
    public function __construct($videoPath, $endpoint)
    {
        $this->path = $videoPath;
        $this->apiEndpoint = $endpoint;
    }

    /**
     * @param $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->data['title'] = $title;

        return $this;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->data['description'] = $description;

        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getApiEndpoint()
    {
        return $this->apiEndpoint;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }
}
