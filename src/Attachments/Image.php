<?php

namespace NotificationChannels\FacebookPoster\Attachments;

class Image
{
    /**
     * The image path.
     *
     * @var string
     */
    protected $path;

    /**
     * The image API endpoint.
     *
     * @var string
     */
    protected $apiEndpoint;

    /**
     * The image API method.
     *
     * @var string
     */
    protected $method = 'fileToUpload';

    /**
     * Create a new image instance.
     *
     * @param  string  $path
     * @param  string  $apiEndpoint
     */
    public function __construct($path, $apiEndpoint)
    {
        $this->path = $path;
        $this->apiEndpoint = $apiEndpoint;
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
