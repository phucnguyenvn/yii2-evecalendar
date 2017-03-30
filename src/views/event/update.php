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
        //remove old Events in current view
        $('#calendar').fullCalendar('removeEvents',result.id);
        //update current view after saved event
        $.each(result.data,function(key,value){
            $('#calendar').fullCalendar('renderEvent',value,false);
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


  //process for delete event button
  $('.delete-event').click(function(e) {
      e.preventDefault();
      var modal = $('#modal-delete').modal('show').css('top','30%');
      $('#delete-confirm').click(function(e) {
          e.preventDefault();
          var \$url = window.location.protocol + "//" + window.location.host + "/";
          $.post(\$url+'calendar/event/delete',{id:$model->id},function(){})
          .done(function(result){
            if(result.message == "success")
            {
              $('#modal-delete').modal('hide');
              $('#modal').modal('hide');
              //remove old Events in current view
              $('#calendar').fullCalendar('removeEvents',result.id);
            }
            else
            {
              return false;
              // console.log(result);
            }
          }).fail(function(){
            console.log("server error");
          });
      });
  });
JS;

$this->registerJs($script);
