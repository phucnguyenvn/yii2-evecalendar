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

$script = <<< JS
  var \$url = window.location.protocol + "//" + window.location.host + "/";
  //action add event button
  function buttonAddEvent()
  {
      $('.btn-add-event').remove();
      $('.fc-day-top').append("<div class='btn-add-event'></div>");
  }
  $('button').click(function(){
    buttonAddEvent();
  });

  //handle event click
  $('#calendar').fullCalendar('option',{
    //click to update current event
    eventClick: function(calEvent, jsEvent, view){
      $.get(\$url+'calendar/event/update',{id:calEvent.id},function(\$data){
        $('#modal').modal('show')
        .find('.modal-body')
        .html(\$data);
      });
    },
    //add event button
    eventAfterAllRender: function( view ){
      buttonAddEvent();
    },

  });
JS;

$this->registerJs($script);
