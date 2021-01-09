<?php

namespace NotificationChannels\FacebookPoster;

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
     * Additional post parameters.
     *
     * @var array
     */
    protected array $params = [];

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
     * Set the post message.
     */
    public function withMessage(?string $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the post message.
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * Set ths post link.
     */
    public function withLink(?string $link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get the post link.
     */
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * Set the post params.
     */
    public function withParams(array $params)
    {
        $this->params = $params;

        return $this;
    }

    /**
     * Get the post params.
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * Get the filtered body.
     */
    public function getBody(): array
    {
        $body = array_merge([
            'message' => $this->message,
            'link' => $this->link,
        ], $this->params);

        return array_filter($body);
    }
}
