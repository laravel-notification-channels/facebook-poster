<?php

namespace NotificationChannels\FacebookPoster\Test;

use DateTime;
use DateTimeImmutable;
use NotificationChannels\FacebookPoster\FacebookPosterPost;

class FacebookPosterPostTest extends TestCase
{
    /** @test */
    public function it_can_be_scheduled()
    {
        $post = new FacebookPosterPost('Test');

        $post->scheduledFor(1234);

        $result = $post->getPostBody();

        $this->assertEquals([
            'message' => 'Test',
            'published' => false,
            'scheduled_publish_time' => 1234,
        ], $result);
    }

    /** @test */
    public function it_can_be_scheduled_with_datetime()
    {
        $post = new FacebookPosterPost('Test');

        $post->scheduledFor(new DateTime('2000-01-01'));

        $result = $post->getPostBody();

        $this->assertEquals([
            'message' => 'Test',
            'published' => false,
            'scheduled_publish_time' => 946684800,
        ], $result);
    }

    /** @test */
    public function it_can_be_scheduled_with_immutable_datetime()
    {
        $post = new FacebookPosterPost('Test');

        $post->scheduledFor(new DateTimeImmutable('2000-01-01'));

        $result = $post->getPostBody();

        $this->assertEquals([
            'message' => 'Test',
            'published' => false,
            'scheduled_publish_time' => 946684800,
        ], $result);
    }
}
