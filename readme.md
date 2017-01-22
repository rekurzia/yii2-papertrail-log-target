
# Yii2 Papertrail log target

[![Build Status](https://travis-ci.org/rekurzia/yii2-papertrail-log-target.svg?branch=master)](https://travis-ci.org/rekurzia/yii2-papertrail-log-target)
[![Latest Stable Version](https://poser.pugx.org/rekurzia/yii2-papertrail-log-target/version)](https://github.com/rekurzia/yii2-papertrail-log-target/releases)
[![Total Downloads](https://poser.pugx.org/rekurzia/yii2-papertrail-log-target/downloads)](https://packagist.org/packages/rekurzia/yii2-papertrail-log-target)
[![License](https://poser.pugx.org/rekurzia/yii2-papertrail-log-target/license)](https://github.com/rekurzia/yii2-papertrail-log-target/blob/master/license.txt)

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
