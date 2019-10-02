<?php

namespace NotificationChannels\FacebookPoster;

use DateTimeInterface;
use NotificationChannels\FacebookPoster\Attachments\Link;
use NotificationChannels\FacebookPoster\Attachments\Image;
use NotificationChannels\FacebookPoster\Attachments\Video;
use NotificationChannels\FacebookPoster\Exceptions\InvalidPostContent;

class FacebookPosterPost
{
    /**
     * The post message.
     *
     * @var string
     */
    protected $message;

    /**
     * The post link.
     *
     * @var string
     */
    protected $link;

    /**
     * The post image.
     *
     * @var \NotificationChannels\FacebookPoster\Attachments\Image
     */
    protected $image;

    /**
     * The post video.
     *
     * @var \NotificationChannels\FacebookPoster\Attachments\Video
     */
    protected $video;

    /**
     * Additional post parameters.
     *
     * @var array
     */
    protected $params;

    /**
     * The post API endpoint.
     *
     * @var string
     */
    protected $apiEndpoint = 'me/feed';

    /**
     * Create a new post instance.
     *
     * @param  string  $message
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get post message.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
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
        $this->link = $link;

        return $this;
    }

    /**
     * Set a post image.
     *
     * @param  string  $path
     * @param  string  $endpoint
     * @return $this
     */
    public function withImage($path, $endpoint = 'me/photos')
    {
        $this->image = new Image($path, $endpoint);

        return $this;
    }

    /**
     * Set a post video.
     *
     * @param  string  $path
     * @param  string  $title
     * @param  string  $description
     * @param  string  $endpoint
     * @return $this
     */
    public function withVideo($path, $title = null, $description = null, $endpoint = 'me/videos')
    {
        $this->video = new Video($path, $title, $description, $endpoint);

        return $this;
    }

    /**
     * Schedule the post for a date in the future.
     *
     * @param  \DateTimeInterface|int  $timestamp
     * @return $this
     */
    public function scheduledFor($timestamp)
    {
        $timestamp = $timestamp instanceof DateTimeInterface
            ? $timestamp->getTimestamp()
            : $timestamp;

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
        $this->validate();

        $body = [
            'message' => $this->getMessage(),
        ];

        if ($this->link != null) {
            $body['link'] = $this->link;
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

    /**
     * Validate that there is acceptable post content.
     *
     * @throws \NotificationChannels\FacebookPoster\Exceptions\InvalidPostContent
     */
    protected function validate()
    {
        if ($this->message || $this->link || $this->image || $this->video) {
            return;
        }

        throw InvalidPostContent::noContentSet();
    }
}
