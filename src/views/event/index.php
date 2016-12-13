<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\web\JsExpression;
use phucnguyenvn\yii2evecalendar\EventCalendar;
use phucnguyenvn\yii2evecalendar\assets\ModuleAsset;
/* @var $this yii\web\View */
/* @var $searchModel app\models\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
ModuleAsset::register($this);
$this->title = 'Events';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
      Modal::begin([
        'header'=>'<h4>Create event</h4>',
        'id'=>'modal',
        'size'=>'modal-md',
        ]);
      Modal::end();

     ?>
    <?= EventCalendar::widget([
            'events' => \yii\helpers\Url::to(['events']),
        ]);
    ?>

<?php

//add event button
$js[] = "jQuery('.fc-day-top').append('<div class=\'btn-add-event\'></div>');";
$this->registerJs(implode("\n", $js),\yii\web\View::POS_READY);

$script = <<< JS
  //action add event button
  function buttonAddEvent()
  {
      $('.btn-add-event').remove();
      $('.fc-day-top').append("<div class='btn-add-event'></div>");
  }
  $('button').click(function(){
    buttonAddEvent();
  });
JS;

$this->registerJs($script);
