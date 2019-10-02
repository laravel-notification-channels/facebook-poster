<?php

namespace NotificationChannels\FacebookPoster\Test;

use Mockery;
use Facebook\Facebook;
use Illuminate\Notifications\Notification;
use NotificationChannels\FacebookPoster\FacebookPosterChannel;

class FacebookPosterChannelTest extends TestCase
{
    /** @var Mockery\Mock */
    protected $facebook;

    /** @var \NotificationChannels\FacebookPoster\FacebookPosterChannel */
    protected $channel;

    public function setUp()
    {
        parent::setUp();

        $this->facebook = Mockery::mock(Facebook::class);
        $this->channel = new FacebookPosterChannel($this->facebook);
    }

    public function tearDown()
    {
        Mockery::close();
        parent::tearDown();
    }

    /** @test */
    public function it_can_send_a_post()
    {
        $this->facebook->shouldReceive('post')->once()->with(
            'me/feed',
            ['message' => 'Laravel Notification Channels are awesome!']
        );

        $this->channel->send(new TestNotifiable(), new TestNotification());
    }

    /** @test */
    public function it_can_send_a_post_with_link()
    {
        $this->facebook->shouldReceive('post')->once()->with(
            'me/feed',
            ['message' => 'Laravel Notification Channels are awesome!', 'link' => 'http://laravel.com']
        );

        $this->channel->send(new TestNotifiable(), new TestNotificationWithLink());
    }

    /** @test */
    public function it_can_send_a_post_with_image()
    {
        $this->facebook->shouldReceive('post')->once()->with('me/photos', ['message' => 'Laravel Notification Channels are awesome!', 'source' => null]);

        $this->facebook->shouldReceive('fileToUpload')->once()->with('image1.png');

        $this->channel->send(new TestNotifiable(), new TestNotificationWithImage());
    }

    /** @test */
    public function it_can_send_a_post_with_video()
    {
        $this->facebook->shouldReceive('post')->once()->with('me/videos', ['message' => 'Laravel Notification Channels are awesome!', 'source' => null, 'title' => 'laravel', 'description' => 'laravel framework.']);

        $this->facebook->shouldReceive('videoToUpload')->once()->with('video1.mp4');

        $this->channel->send(new TestNotifiable(), new TestNotificationWithVideo());
    }
}
