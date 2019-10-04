<?php

namespace NotificationChannels\FacebookPoster;

use DateTimeInterface;
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
     * The post media.
     *
     * @var \NotificationChannels\FacebookPoster\Attachments\Attachment
     */
    protected $media;

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
    protected $endpoint = 'me/feed';

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
     * Get the post message.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set a post link.
     *
     * @param  string  $link
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
        $this->media = new Image($path);
        $this->endpoint = $endpoint;

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
        $this->media = new Video($path);
        $this->params['title'] = $title;
        $this->params['description'] = $description;
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * Schedule the post for a date in the future.
     *
     * @param  \DateTimeInterface  $timestamp
     * @return $this
     */
    public function scheduledFor(DateTimeInterface $timestamp)
    {
        $this->params['published'] = false;
        $this->params['scheduled_publish_time'] = $timestamp->getTimestamp();

        return $this;
    }

    /**
     * Return Facebook API endpoint.
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * Get the media attached to the post.
     *
     * @return \NotificationChannels\FacebookPoster\Attachment
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Build Facebook post request body.
     *
     * @return array
     */
    public function getBody()
    {
        $this->validate();

        $body = [
            'message' => $this->getMessage(),
        ];

        if ($this->link != null) {
            $body['link'] = $this->link;
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
        if ($this->message || $this->link || $this->media) {
            return;
        }

        throw InvalidPostContent::noContentSet();
    }
}
