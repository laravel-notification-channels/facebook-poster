<?php

namespace NotificationChannels\FacebookPoster\Attachments;

class Video extends Attachment
{
    /**
     * The video title.
     *
     * @var string
     */
    protected $title;

    /**
     * The video description.
     *
     * @var string
     */
    protected $description;

    /**
     * The video API method.
     *
     * @var string
     */
    protected $apiMethod = 'videoToUpload';

    /**
     * Create a new video instance.
     *
     * @param  string  $path
     * @param  string  $title
     * @param  string  $description
     * @param  string  $apiEndpoint
     * @return void
     */
    public function __construct($path, $title = null, $description = null, $apiEndpoint)
    {
        $this->path = $path;
        $this->title = $title;
        $this->description = $description;
        $this->apiEndpoint = $apiEndpoint;
    }

    /**
     * Get additional attachment data.
     *
     * @return array
     */
    public function getData()
    {
        return array_filter([
            'title' => $this->title,
            'description' => $this->description,
        ]);
    }
}
