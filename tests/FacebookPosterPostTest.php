<?php

namespace NotificationChannels\FacebookPoster\Tests;

use NotificationChannels\FacebookPoster\FacebookPosterPost;
use PHPUnit\Framework\Attributes\Test;

class FacebookPosterPostTest extends TestCase
{
    #[Test]
    public function it_can_be_instantiated()
    {
        $post = new FacebookPosterPost('message');

        $this->assertInstanceOf(FacebookPosterPost::class, $post);

        $result = $post->getBody();

        $this->assertEquals([
            'message' => 'message',
        ], $result);
    }

    #[Test]
    public function it_can_be_instantiated_with_arguments()
    {
        $post = new FacebookPosterPost(
            message: 'message',
            link: 'https://laravel.com',
            params: ['foo' => 'bar'],
        );

        $result = $post->getBody();

        $this->assertEquals([
            'message' => 'message',
            'link' => 'https://laravel.com',
            'foo' => 'bar',
        ], $result);
    }

    #[Test]
    public function it_can_be_instantiated_with_setters()
    {
        $post = (new FacebookPosterPost)
            ->withMessage('message')
            ->withLink('https://laravel.com')
            ->withParams([
                'foo' => 'bar',
            ]);

        $result = $post->getBody();

        $this->assertEquals([
            'message' => 'message',
            'link' => 'https://laravel.com',
            'foo' => 'bar',
        ], $result);
    }

    #[Test]
    public function it_returns_filtered_body()
    {
        $post = new FacebookPosterPost('message');

        $result = $post->getBody();

        $this->assertEquals([
            'message' => 'message',
        ], $result);
    }

    #[Test]
    public function it_publishes_to_the_feed_edge()
    {
        $post = new FacebookPosterPost();

        $this->assertEquals('feed', $post->getEdge());
    }
}
