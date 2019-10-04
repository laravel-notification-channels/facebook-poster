<?php

namespace NotificationChannels\FacebookPoster\Tests;

use DateTime;
use DateTimeImmutable;
use NotificationChannels\FacebookPoster\FacebookPosterPost;

class FacebookPosterPostTest extends TestCase
{
    /** @test */
    public function it_can_be_scheduled()
    {
        $post = new FacebookPosterPost('message');

        $post->scheduledFor(new DateTime('2000-01-01'));

        $result = $post->getBody();

        $this->assertEquals([
            'message' => 'message',
            'published' => false,
            'scheduled_publish_time' => 946684800,
        ], $result);
    }

    /** @test */
    public function it_can_be_scheduled_with_immutable_datetime()
    {
        $post = new FacebookPosterPost('message');

        $post->scheduledFor(new DateTimeImmutable('2000-01-01'));

        $result = $post->getBody();

        $this->assertEquals([
            'message' => 'message',
            'published' => false,
            'scheduled_publish_time' => 946684800,
        ], $result);
    }
}
