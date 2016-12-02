<?php

namespace phucnguyenvn\yii2evecalendar;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'phucnguyenvn\yii2evecalendar\controllers';
    public $defaultRoute = 'event/index';
    public function init()
    {
        parent::init();
    }
}
