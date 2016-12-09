<?php
namespace phucnguyenvn\yii2evecalendar\assets;

use yii\web\AssetBundle;

class FormAssets extends AssetBundle
{
    public $sourcePath = '@vendor/phucnguyenvn/yii2-evecalendar/src/assets';
    public $css = [
      //  'css/jquery-ui.css'
    ];
    public $js = [
      //  'js/jquery-ui.js',
        'js/nlp.js',
        'js/rrule-gui.js',
        'js/rrule.js'
    ];
    public $depends = [

    ];
}
