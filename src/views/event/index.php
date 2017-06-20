<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\web\JsExpression;
use phucnguyenvn\yii2evecalendar\EventCalendar;
use phucnguyenvn\yii2evecalendar\assets\ModuleAsset;
/* @var $this yii\web\View */
/* @var $searchModel app\models\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
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
     <?php Modal::begin([
         'header' => '<h3 class="modal-title">hihii</h3>',
         'id'     => 'modal-notify',
         'size'   => 'modal-sm',
         'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>',
     ]); ?>
     <p class='modal-notify-body'><p>
     <?php Modal::end(); ?>
     <?php Modal::begin([
         'header' => '<h3 class="modal-title">Confirm Delete</h3>',
         'id'     => 'modal-delete',
         'size'   => 'modal-sm',
         'footer' => '<button type="button" class="btn btn-default cancel-delete-modal">Cancel</button>
                      <button type="button" class="btn btn-danger" id="delete-confirm">Delete</button>',
     ]); ?>
     <?= 'Do you want to delete this event?'; ?>
     <?php Modal::end(); ?>
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
      //btn add event month view
      $('.fc-day-top.fc-future,.fc-day-top.fc-today').append("<div class='btn-add-event btn-add-event-month'></div>");
      //btn add event week view
      $('.fc-agendaWeek-view .fc-day-header').each(function( key, value ) {
            if(new Date($(this).attr('data-date')).setHours(0, 0, 0, 0) >= new Date().setHours(0, 0, 0, 0))
            {
              $(this).append("<div class='btn-add-event btn-add-event-week'></div>");
            }
      });
      //btn add event day view
      $('.fc-agendaDay-view .fc-day-header').each(function( key, value ) {
        if(new Date($(this).attr('data-date')).setHours(0, 0, 0, 0) >= new Date().setHours(0, 0, 0, 0))
        {
            $(this).append("<div class='btn-add-event btn-add-event-day'></div>");
        }
      });
  }
  $('button').click(function(){
    buttonAddEvent();
  });

  //handle event click
  $('#calendar').fullCalendar('option',{
    //click to update current event
    eventClick: function(calEvent, jsEvent, view){
      //send also date-range of the current view to update view when CRUD events
      var \$dstart = $('#calendar').fullCalendar('getView').start.format(); //start date of current view
      var \$dend = $('#calendar').fullCalendar('getView').end.format(); //end date of current view
      $.get(\$url+'calendar/event/update',{dstart:\$dstart,dend:\$dend,id:calEvent.id},function(\$data){
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

  //ajax loading animation
  $(document).ajaxStart(function(){
    $.LoadingOverlay("show");
  });
  $(document).ajaxStop(function(){
      $.LoadingOverlay("hide");
  });
JS;

$this->registerJs($script);
