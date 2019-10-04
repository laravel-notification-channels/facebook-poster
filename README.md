# FacebookPoster Notification Channel For Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/laravel-notification-channels/facebook-poster.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/facebook-poster)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/laravel-notification-channels/facebook-poster/master.svg?style=flat-square)](https://travis-ci.org/laravel-notification-channels/facebook-poster)
[![StyleCI](https://styleci.io/repos/73361533/shield)](https://styleci.io/repos/73361533)
[![Quality Score](https://img.shields.io/scrutinizer/g/laravel-notification-channels/facebook-poster.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-notification-channels/facebook-poster)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/laravel-notification-channels/facebook-poster/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-notification-channels/facebook-poster/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel-notification-channels/facebook-poster.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/facebook-poster)

This package makes it easy to post to Facebook using Laravel notification channels.

## Contents

- [Installation](#installation)
- [Setting up the Facebook posts service](#setting-up-the-facebook-poster-service)
- [Usage](#usage)
	- [Publish Facebook post](#publish-facebook-post)
	- [Publish Facebook post with link](#publish-facebook-post-with-link)
	- [Publish Facebook post with image](#publish-facebook-post-with-image)
	- [Publish Facebook post with video](#publish-facebook-post-with-video)
	- [Publish Facebook scheduled post](#publish-facebook-scheduled-post)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation

You can install this package via Composer:

``` bash
composer require laravel-notification-channels/facebook-poster
```

### Configuration

You will need to [create](https://developers.facebook.com/apps) a Facebook app in order to use this channel. Within in this app you will find the app ID and secret. Place them inside your `.env` file. In order to load them, add this to your `config/services.php` file:

```php
...
'facebook_poster' => [
    'client_id' => getenv('FACEBOOK_APP_ID'),
    'client_secret' => getenv('FACEBOOK_APP_SECRET'),
    'access_token' => getenv('FACEBOOK_ACCESS_TOKEN'),
],
```

You will need to create a long-life access token for your Facebook page. You can do so with the [Graph API Explorer](https://developers.facebook.com/tools/explorer). Select your Facebook App, then select a Page Access Token for your page. Next, make sure you have both `manage_pages` and `publish_pages` as permissions - you may be prompted to authorize them.

Once you have an access token, copy it into the [Access Token Tool](https://developers.facebook.com/tools/debug/accesstoken) to extend it for a longer period of time so it doesn't expire.

## Usage

Follow Laravel's [documentation](https://laravel.com/docs/master/notifications) to add the channel to your Notification class.

### Publish Facebook post

```php
use NotificationChannels\FacebookPoster\FacebookPosterChannel;
use NotificationChannels\FacebookPoster\FacebookPosterPost;

class NewsWasPublished extends Notification
{

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [FacebookPosterChannel::class];
    }

    /** 
     * Get the Facebook post representation of the notification.
     *
     * @param  mixed  $notifiable.
     * @return \NotificationChannels\FacebookPoster\FacebookPosterPost
     */
    public function toFacebookPoster($notifiable) {
        return new FacebookPosterPost('Laravel notifications are awesome!');
    }
}
```

### Publish Facebook post with link
It is possible to publish link with your post too. You just have to pass the URL to the `withLink` method.

```php
public function toFacebookPoster($notifiable) {
    return (new FacebookPosterPost('Laravel notifications are awesome!'))
        ->withLink('https://laravel.com');
}
```

### Publish Facebook post with image
It is possible to publish image with your post too. You just have to pass the image path to the `withImage` method.

```php
public function toFacebookPoster($notifiable) {
    return (new FacebookPosterPost('Laravel notifications are awesome!'))
        ->withImage(url('image.jpg'));
}
```

Note that an absolute URL is required.

### Publish Facebook post with video
It is also possible to publish video with your post too. You just have to pass the video path to the `withVideo` method.

```php
public function toFacebookPoster($notifiable) {
    return (new FacebookPosterPost('Laravel notifications are awesome!'))
    	->withVideo('video.mp4', 'My video',  'Remember to like and subscribe.');
}
```

### Publish Facebook scheduled post
It is also possible to publish a scheduled post. You just need to pass an instance of `DateTimeInterface` in - so any `DateTime` or Carbon instance will work.

```php
public function toFacebookPoster($notifiable) {
    return (new FacebookPosterPost('Laravel notifications are awesome!'))
    	->scheduledFor(now()->addWeek());
}
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Ahmed Ashraf](https://github.com/ahmedash95)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
