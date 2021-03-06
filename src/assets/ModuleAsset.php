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
        'js/loadingoverlay.min.js',
        'js/nlp.js',
        'js/rrule-gui.js',
        'js/rrule.js'
    ];
    public $depends = [
      'yii\web\YiiAsset',
      'yii\bootstrap\BootstrapAsset',
      'edofre\fullcalendar\CoreAsset',
      'yii\jui\JuiAsset'
    ];
}
