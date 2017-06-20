<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model phucnguyenvn\yii2evecalendar\models\Event */

?>
<h3 class='text-center'>Create event:</h3>
<div class="event-create">

  <?= $this->render('_form', [
      'model' => $model,
  ]) ?>

</div>
<?php
  //hanled ajax submit form
  $script = <<< JS
  $('form#event-form').on('beforeSubmit',function(e){

    var \$form = $(this);
    $.post(
        \$form.attr("action"),
        \$form.serialize()+"&submit=true"
    )
    .done(function(result){
      //if new model saved
      if(result.message == "success")
      {
        //update current view after saved event
        $.each(result.data,function(key,value){
          {
              $('#calendar').fullCalendar('renderEvent',value,false);
              console.log(value);
          }
        });
        $('#modal').modal('hide');
      }
      else
      {
        return false;
        console.log(result);
      }
    }).fail(function(){
      console.log("server error");
    });
    return false;
  });
JS;

$this->registerJs($script);
