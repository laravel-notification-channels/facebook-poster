<?php

namespace NotificationChannels\FacebookPoster\Tests;

use NotificationChannels\FacebookPoster\FacebookPosterPost;

class FacebookPosterPostTest extends TestCase
{
    public function test_it_can_be_instantiated()
    {
        $post = new FacebookPosterPost('message');

        $this->assertInstanceOf(FacebookPosterPost::class, $post);

        $result = $post->getBody();

        $this->assertEquals([
            'message' => 'message',
        ], $result);
    }

    public function test_it_can_be_instantiated_with_arguments()
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

    /** @test */
    public function test_it_can_be_instantiated_with_setters()
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

    /** @test */
    public function it_can_publish_an_image()
    {
        $post = (new FacebookPosterPost('message'))
            ->withImage('https://example.com/image.jpg')
            ->withLink('https://laravel.com');

        $this->assertSame('photos', $post->getGraphEdge());

        $this->assertEquals([
            'caption' => "message\nhttps://laravel.com",
            'url' => 'https://example.com/image.jpg',
        ], $post->getBody());
    }

    /** @test */
    public function it_does_not_repeat_a_link_already_present_in_the_caption()
    {
        $post = (new FacebookPosterPost("message\nhttps://laravel.com"))
            ->withImage('https://example.com/image.jpg')
            ->withLink('https://laravel.com');

        $this->assertEquals([
            'caption' => "message\nhttps://laravel.com",
            'url' => 'https://example.com/image.jpg',
        ], $post->getBody());
    }

    /** @test */
    public function it_returns_filtered_body()
    {
        $post = new FacebookPosterPost('message');

        $result = $post->getBody();

        $this->assertEquals([
            'message' => 'message',
        ], $result);
    }
}
