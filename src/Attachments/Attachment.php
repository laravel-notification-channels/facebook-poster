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
     * The attachment API endpoint.
     *
     * @var string
     */
    protected $apiEndpoint;

    /**
     * The attachment API method.
     *
     * @var string
     */
    protected $apiMethod = null;

    /**
     * Get the attachment path.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Get the attachment API endpoint.
     *
     * @return string
     */
    public function getApiEndpoint()
    {
        return $this->apiEndpoint;
    }

    /**
     * Get the attachment API method.
     *
     * @return string
     */
    public function getApiMethod()
    {
        return $this->apiMethod;
    }

    /**
     * Get additional attachment data.
     *
     * @return array
     */
    public function getData()
    {
        return [];
    }
}

