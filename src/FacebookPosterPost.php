<?php

namespace NotificationChannels\FacebookPoster;

use NotificationChannels\FacebookPoster\Attachments\Link;
use NotificationChannels\FacebookPoster\Attachments\Image;
use NotificationChannels\FacebookPoster\Attachments\Video;

class FacebookPosterPost
{
    /** @var string */
    protected $content;

    /** @object FacebookPosterLink */
    protected $link;

    /** @object FacebookPosterImage */
    protected $image;

    /** @object FacebookPosterVideo */
    protected $video;

    /** @var array */
    protected $params;

    /**
     * @var string
     */
    private $apiEndpoint = 'me/feed';

    public function __construct($postContent)
    {
        $this->content = $postContent;
    }

    /**
     * Get Post content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set facebook post main link.
     *
     * @param string $link
     *
     * @return $this
     */
    public function withLink($link)
    {
        $this->link = new Link($link);

        return $this;
    }

    /**
     * Set facebook post image.
     *
     * @param $imagePath
     * @param string $endpoint
     *
     * @return $this
     */
    public function withImage($imagePath, $endpoint = 'me/photos')
    {
        $this->image = new Image($imagePath, $endpoint);

        return $this;
    }

    /**
     * Set facebook post image.
     *
     * @param $videoPath
     * @param array  $data
     * @param string $endpoint
     *
     * @return $this
     */
    public function withVideo($videoPath, $data = [], $endpoint = 'me/videos')
    {
        $this->video = new video($videoPath, $endpoint);

        if (isset($data['title'])) {
            $this->video->setTitle($data['title']);
        }

        if (isset($data['description'])) {
            $this->video->setDescription($data['description']);
        }

        return $this;
    }

    /**
     * Schedule the post for a date in the future.
     *
     * @param string $timestamp UNIX timestamp
     *
     * @return $this
     */
    public function scheduledFor($timestamp)
    {
        $this->params['published'] = false;
        $this->params['scheduled_publish_time'] = $timestamp;

        return $this;
    }

    /**
     * Return Facebook Post api endpoint.
     *
     * @return string
     */
    public function getApiEndpoint()
    {
        return $this->apiEndpoint;
    }

    /**
     * Build Facebook post request body.
     *
     * @return array
     */
    public function getPostBody()
    {
        $body = [
            'message' => $this->getContent(),
        ];

        if ($this->link != null) {
            $body['link'] = $this->link->getUrl();
        }

        if ($this->image != null) {
            $body['media'] = $this->image;
        }

        if ($this->video != null) {
            $body['media'] = $this->video;
        }

        if ($this->params != null) {
            $body = array_merge($body, $this->params);
        }

        return $body;
    }
}
