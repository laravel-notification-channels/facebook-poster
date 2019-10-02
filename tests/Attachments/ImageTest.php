<?php

namespace NotificationChannels\FacebookPoster\Tests;

use NotificationChannels\FacebookPoster\Attachments\Image;
use NotificationChannels\FacebookPoster\Tests\TestCase;

class ImageTest extends TestCase
{
    /** @test */
    public function it_can_be_instantiated()
    {
        $image = new Image('path', 'endpoint');

        $this->assertInstanceOf(Image::class, $image);
    }

    /** @test */
    public function it_returns_given_path()
    {
        $image = new Image('path', 'endpoint');

        $result = $image->getPath();

        $this->assertEquals('path', $result);
    }

    /** @test */
    public function it_returns_given_endpoint()
    {
        $image = new Image('path', 'endpoint');

        $result = $image->getApiEndpoint();

        $this->assertEquals('endpoint', $result);
    }

    /** @test */
    public function it_returns_method()
    {
        $image = new Image('path', 'endpoint');

        $result = $image->getMethod();

        $this->assertEquals('fileToUpload', $result);
    }
}
