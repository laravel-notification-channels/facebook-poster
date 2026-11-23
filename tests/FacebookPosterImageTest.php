<?php

namespace NotificationChannels\FacebookPoster\Tests;

use NotificationChannels\FacebookPoster\FacebookPosterImage;

class FacebookPosterImageTest extends TestCase
{
    public function test_it_can_be_instantiated()
    {
        $image = new FacebookPosterImage('https://example.com/image.jpg');

        $this->assertEquals([
            'url' => 'https://example.com/image.jpg',
        ], $image->getBody());
    }

    public function test_it_can_be_instantiated_with_arguments()
    {
        $image = new FacebookPosterImage(
            url: 'https://example.com/image.jpg',
            caption: 'caption',
            params: ['foo' => 'bar'],
        );

        $this->assertEquals([
            'url' => 'https://example.com/image.jpg',
            'caption' => 'caption',
            'foo' => 'bar',
        ], $image->getBody());
    }

    public function test_it_can_be_instantiated_with_setters()
    {
        $image = (new FacebookPosterImage('https://example.com/image.jpg'))
            ->withCaption('caption')
            ->withParams(['foo' => 'bar']);

        $this->assertEquals([
            'url' => 'https://example.com/image.jpg',
            'caption' => 'caption',
            'foo' => 'bar',
        ], $image->getBody());
    }

    public function test_it_publishes_to_the_photos_edge()
    {
        $image = new FacebookPosterImage('https://example.com/image.jpg');

        $this->assertEquals('photos', $image->getEdge());
    }
}
