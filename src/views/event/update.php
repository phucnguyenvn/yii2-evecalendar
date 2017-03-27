<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model phucnguyenvn\yii2evecalendar\models\Event */

?>
<h3 class='text-center'><?php echo 'Update Event: ' . $model->title; ?></h3>
<div class="event-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php
  //hanled ajax submit form
  $script = <<< JS

  //process current RRULE
  if($('input#event-recurrence').val() !== '')
  {
    readRule($('input#event-recurrence').val());
  }


  $('form#event-form').on('beforeSubmit',function(e){
    var \$url = window.location.protocol + "//" + window.location.host + "/";
    var \$form = $(this);
    $.post(
        \$form.attr("action"),
        \$form.serialize()
    )
    .done(function(result){
      //if new model saved
      if(result.message == "success")
      {
        $('#modal').modal('hide');
        //update current view after saved event
        console.log(result);
        $.each(result.data,function(key,value){
          {
              $('#calendar').fullCalendar('renderEvent',value,false);
          }
        });
      }
      else
      {
        return false;
        // console.log(result);
      }
    }).fail(function(){
      console.log("server error");
    });
    return false;
  });
JS;

$this->registerJs($script);
