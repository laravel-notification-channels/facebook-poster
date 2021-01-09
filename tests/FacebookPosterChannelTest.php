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
        $this->config->shouldReceive('get')->with('services.facebook_poster.page_id')->andReturn('pageId');
        $this->config->shouldReceive('get')->with('services.facebook_poster.access_token')->andReturn('accessToken');

        $this->guzzle->shouldReceive('post')->with(
            'https://graph.facebook.com/v9.0/pageId/feed?access_token=accessToken',
            ['form_params' => ['message' => 'message']],
        );

        $this->channel->send(new TestNotifiable, new TestNotification);
    }

    /** @test */
    public function it_can_send_a_post_with_link()
    {
        $this->config->shouldReceive('get')->with('services.facebook_poster.page_id')->andReturn('pageId');
        $this->config->shouldReceive('get')->with('services.facebook_poster.access_token')->andReturn('accessToken');

        $this->guzzle->shouldReceive('post')->with(
            'https://graph.facebook.com/v9.0/pageId/feed?access_token=accessToken',
            ['form_params' => ['message' => 'message', 'link' => 'https://laravel.com']],
        );

        $this->channel->send(new TestNotifiable, new TestNotificationWithLink);
    }

    /** @test */
    public function it_can_send_post_with_custom_routing()
    {
        $this->config->shouldNotReceive('get');

        $this->guzzle->shouldReceive('post')->with(
            'https://graph.facebook.com/v9.0/customPageId/feed?access_token=customAccessToken',
            ['form_params' => ['message' => 'message']],
        );

        $this->channel->send(new TestNotifiableWithCustomRouting, new TestNotification);
    }
}
