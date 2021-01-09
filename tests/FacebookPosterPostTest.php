<?php

namespace NotificationChannels\FacebookPoster\Tests;

use NotificationChannels\FacebookPoster\FacebookPosterPost;

class FacebookPosterPostTest extends TestCase
{
    /** @test */
    public function it_returns_body()
    {
        $post = (new FacebookPosterPost('message'))
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
    public function it_returns_filtered_body()
    {
        $post = new FacebookPosterPost('message');

        $result = $post->getBody();

        $this->assertEquals([
            'message' => 'message',
        ], $result);
    }
}
