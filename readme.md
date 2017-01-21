
# Yii2 Papertrail log target

[![Build Status](https://travis-ci.org/rekurzia/yii2-papertrail-log-target.svg?branch=master)](https://travis-ci.org/rekurzia/yii2-papertrail-log-target)

Yii2 log target which sends log messages to Papertrail.

## Installation

```
composer require rekurzia/yii2-papertrail-log-target
```

## Usage

Add Sentry target to your configuration

```php
$config['components']['log']['targets'] = [
    [
        'class' => Rekurzia\Log\PapertrailTarget::class,
        'levels' => ['error', 'warning'],
        'host' => 'logs[xxx].papertrailapp.com',
        'port' => 1234,
    ],
];
```

## License

MIT. See [license.txt](license.txt) file.
