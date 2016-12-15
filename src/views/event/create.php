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

  var s_time,e_time = null;
  //hide time field
  var hide_time = function(){
    $('.field-event-s_time').hide();
    $('.field-event-e_time').hide();
    s_time = $('input#event-s_time').val(); //backup selected time
    e_time = $('input#event-e_time').val(); //backup selected time
    $('input#event-s_time').val(null);
    $('input#event-e_time').val(null);
  }
  //show time field
  var show_time = function(){
    $('.field-event-s_time').show();
    $('.field-event-e_time').show();
    $('input#event-s_time').val(s_time);
    $('input#event-e_time').val(e_time);
  }
  //check if all day is checked => hide time field
  if($('#all-day').attr('checked'))
  {
    hide_time();
  }
  //all day on change event
  $('#all-day').change(function(){
    if(this.checked){
      hide_time();
    }
    else{
      show_time();
    }
  });

  //cancel button
  $(".modal-cancel").click(function(){
      $('#modal').modal('hide');
  });

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
        console.log(result);
      }
    }).fail(function(){
      console.log("server error");
    });
    return false;
  });
JS;

$this->registerJs($script);
