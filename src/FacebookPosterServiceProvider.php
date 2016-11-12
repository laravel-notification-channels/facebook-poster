<?php

namespace NotificationChannels\FacebookPoster;

use Illuminate\Support\ServiceProvider;

class FacebookPosterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // Bootstrap code here.
        $this->app->when(FacebookPosterChannel::class)
            ->needs(\Facebook\Facebook::class)
            ->give(function () {
                return new \Facebook\Facebook([
                    'app_id' => config('services.facebook_poster.app_id'),
                    'app_secret' => config('services.facebook_poster.app_secret'),
                    'default_access_token' => config('services.facebook_poster.access_token'),
                ]);
            });
    }

    /**
     * Register any package services.
     */
    public function register()
    {
    }
}
