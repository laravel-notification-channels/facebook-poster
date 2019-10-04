<?php

namespace NotificationChannels\FacebookPoster;

use Facebook\Facebook;
use Illuminate\Support\ServiceProvider;

class FacebookPosterServiceProvider extends ServiceProvider
{
    /**
     * Register any package services.
     */
    public function register()
    {
        $this->app->when(FacebookPosterChannel::class)
            ->needs(Facebook::class)
            ->give(function ($app) {
                return new Facebook([
                    'app_id' => $app['config']['services.facebook_poster.client_id'],
                    'app_secret' => $app['config']['services.facebook_poster.client_secret'],
                    'default_access_token' => $app['config']['services.facebook_poster.access_token'],
                ]);
            });
    }
}
