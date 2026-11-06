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
        public array $params = [],
        public ?string $image = null,
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
     * Set a publicly reachable image URL.
     *
     * A photo is published to the Page photos edge. Facebook does not turn
     * that image into a link preview, so a link is appended to the caption.
     */
    public function withImage(?string $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Graph edge used to publish this post.
     */
    public function getGraphEdge(): string
    {
        return $this->image ? 'photos' : 'feed';
    }

    /**
     * Get the filtered body.
     */
    public function getBody(): array
    {
        if ($this->image) {
            $body = array_merge([
                'caption' => $this->caption(),
                'url' => $this->image,
            ], $this->params);

            return array_filter($body);
        }

        $body = array_merge([
            'message' => $this->message,
            'link' => $this->link,
        ], $this->params);

        return array_filter($body);
    }

    /**
     * Caption for a photo post, including the link when it is not already present.
     */
    protected function caption(): ?string
    {
        $caption = trim($this->message ?? '');

        if ($this->link && ! str_contains($caption, $this->link)) {
            $caption = trim($caption."\n".$this->link);
        }

        return $caption === '' ? null : $caption;
    }
}
