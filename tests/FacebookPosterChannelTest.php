<?php

namespace NotificationChannels\FacebookPoster\Tests;

use GuzzleHttp\Client;
use Illuminate\Contracts\Config\Repository;
use Mockery;
use NotificationChannels\FacebookPoster\FacebookPosterChannel;

class FacebookPosterChannelTest extends TestCase
{
    /** @var Mockery\Mock */
    protected $guzzle;

    /** @var Mockery\Mock */
    protected $config;

    /** @var \NotificationChannels\FacebookPoster\FacebookPosterChannel */
    protected $channel;

    public function setUp(): void
    {
        parent::setUp();

        $this->guzzle = Mockery::mock(Client::class);
        $this->config = Mockery::mock(Repository::class);
        $this->channel = new FacebookPosterChannel($this->guzzle, $this->config);
    }

    /** @test */
    public function it_can_send_a_post()
    {
        $this->guzzle->shouldReceive('post')->once()->with(
            'me/feed',
            ['message' => 'message']
        );

        $this->channel->send(new TestNotifiable(), new TestNotification());
    }

    /** @test */
    public function it_can_send_a_post_with_link()
    {
        $this->guzzle->shouldReceive('post')->once()->with(
            'me/feed',
            ['message' => 'message', 'link' => 'http://laravel.com']
        );

        $this->channel->send(new TestNotifiable(), new TestNotificationWithLink());
    }

    /** @test */
    public function it_can_send_a_post_with_image()
    {
        $this->guzzle->shouldReceive('post')->once()->with('me/photos', [
            'source' => null,
            'message' => 'message',
        ]);

        $this->facebook->shouldReceive('fileToUpload')->once()->with('image1.png');

        $this->channel->send(new TestNotifiable(), new TestNotificationWithImage());
    }

    /** @test */
    public function it_can_send_a_post_with_video()
    {
        $this->guzzle->shouldReceive('post')->once()->with('me/videos', [
            'source' => null,
            'title' => 'title',
            'description' => 'description',
            'message' => 'message',
        ]);

        $this->facebook->shouldReceive('videoToUpload')->once()->with('video1.mp4');

        $this->channel->send(new TestNotifiable(), new TestNotificationWithVideo());
    }
}
