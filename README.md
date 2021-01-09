# FacebookPoster Notification Channel For Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/laravel-notification-channels/facebook-poster.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/facebook-poster)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
![Build Status](https://github.com/laravel-notification-channels/facebook-poster/workflows/test/badge.svg)
[![StyleCI](https://styleci.io/repos/73361533/shield)](https://styleci.io/repos/73361533)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel-notification-channels/facebook-poster.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/facebook-poster)

This package makes it easy to post to Facebook using Laravel notification channels.

## Contents

- [Installation](#installation)
- [Setting up the Facebook posts service](#setting-up-the-facebook-poster-service)
- [Usage](#usage)
  - [Publish Facebook post](#publish-facebook-post)
  - [Publish Facebook post with link](#publish-facebook-post-with-link)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)

## Installation

You can install this package via Composer:

```bash
composer require laravel-notification-channels/facebook-poster
```

### Configuration

You'll need to get the Facebook Page ID as well as a page access token with the `pages_read_engagement` and `pages_manage_post` permissions. You will need to go through App Review in order to use these permissions. Then, add the configuration to your `config/services.php` file:

```php
...
'facebook_poster' => [
    'page_id' => env('FACEBOOK_PAGE_ID'),
    'access_token' => env('FACEBOOK_ACCESS_TOKEN'),
],
```

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

### Publish Facebook post with custom configuration

You can implement `routeNotificationForFacebookPoster()` on your notifiable class in order to provide custom configuration.

```php
public function routeNotificationForFacebookPoster(): array
{
    return [
        'page_id' => 'customPageId',
        'access_token' => 'customAccessToken',
    ];
}
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

```bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Ahmed Ashraf](https://github.com/ahmedash95)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
