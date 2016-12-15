# yii2-evecalendar

Yii2 calendar and event management is an AJAX based, modern interface calendar. A module which help you easy manage event and schedule and integrate to your application. This modules depends of following extension:

* [Yii2-fullcalendar](https://github.com/Edofre/yii2-fullcalendar) (by [Edofre](https://github.com/Edofre)) - use to handle front-end interface, display an events.
* [Recurr](https://github.com/simshaun/recurr) (by [simshaun](https://github.com/simshaun)) - use to handle a repeat events.
* [Yii2-widget-timepicker](https://github.com/kartik-v/yii2-widget-timepicker) (by [kartik-v](https://github.com/kartik-v)) - a form widget to input time.


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist phucnguyenvn/yii2-evecalendar "*"
```

or add

```
"phucnguyenvn/yii2-evecalendar": "*"
```

to the require section of your `composer.json` file.

Migration
------------

```
php yii migrate --migrationPath=@vendor/phucnguyenvn/yii2-evecalendar/src/migrations
```

Usage
------------

## Configuring to manage Calendar and Event in web interface

### Register module
Configure **config/web.php** as follows

```php
  'modules' => [
            ................
      'calendar' => [
          'class' => 'phucnguyenvn\yii2evecalendar\Module'
      ],
            ................
  ],
```

### Configure timeZone
Configure **config/web.php** as follows

```php
    $config = [
      'timezone' => 'Asia/Ho_Chi_Minh',
      ...
      ...
    ]
```

* Pretty Url's /calendar

* No pretty Url's index.php?r=calendar
