<?php

namespace NotificationChannels\FacebookPoster;

class FacebookPosterPost
{
    /**
     * Create a new post instance.
     */
    public function __construct(
        public ?string $message = null,
        public ?string $link = null,
        public array $params = []
    ) {
        //
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
     * Set ths post link.
     */
    public function withLink(?string $link)
    {
        $this->link = $link;

        return $this;
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
