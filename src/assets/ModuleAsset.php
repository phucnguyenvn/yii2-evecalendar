<?php
namespace phucnguyenvn\yii2evecalendar\assets;

use yii\web\AssetBundle;

class ModuleAsset extends AssetBundle
{
    public $sourcePath = '@vendor/phucnguyenvn/yii2-evecalendar/src/assets';
    public $css = [
        'css/main.css',
    ];
    public $js = [
        'js/main.js',
    ];
    public $depends = [
      'edofre\fullcalendar\CoreAsset',
      'yii\web\YiiAsset',
      'yii\bootstrap\BootstrapAsset',
    ];
}
