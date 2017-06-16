<?php
namespace phucnguyenvn\yii2evecalendar\assets;

use yii\web\AssetBundle;

class FormAssets extends AssetBundle
{
    public $sourcePath = '@vendor/phucnguyenvn/yii2-evecalendar/src/assets';
    public $css = [
    ];
    public $js = [
        'js/nlp.js',
        'js/rrule-gui.js',
        'js/rrule.js'
    ];
    // public $depends = [
    //   'phucnguyenvn\yii2evecalendar\assets\ModuleAsset',
    // ];
}
