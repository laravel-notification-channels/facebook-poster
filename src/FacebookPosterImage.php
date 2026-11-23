<?php

namespace NotificationChannels\FacebookPoster;

class FacebookPosterImage
{
    /**
     * Create a new image post instance.
     *
     * The image is published to the Page photos edge, so the URL must be
     * publicly reachable by Facebook.
     */
    public function __construct(
        public string $url,
        public ?string $caption = null,
        public array $params = [],
    ) {
        //
    }

    /**
     * Set the image caption.
     */
    public function withCaption(?string $caption)
    {
        $this->caption = $caption;

        return $this;
    }

    /**
     * Set the image params.
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
            'url' => $this->url,
            'caption' => $this->caption,
        ], $this->params);

        return array_filter($body);
    }
}
