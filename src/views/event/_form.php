<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model phucnguyenvn\yii2evecalendar\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-form">

    <?php $form = ActiveForm::begin(['id'=>'event-form']); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'lbnref')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cat_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'notice_mail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 's_date')->textInput() ?>

    <?= $form->field($model, 'e_date')->textInput() ?>

    <?= $form->field($model, 's_time')->textInput() ?>

    <?= $form->field($model, 'e_time')->textInput() ?>

    <?= $form->field($model, 'last_run')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'recurrence')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $script = <<< JS
  $('form#event-form').on('beforeSubmit',function(e){
    var \$url = window.location.protocol + "//" + window.location.host + "/";
    var \$form = $(this);
    $.post(
        \$form.attr("action"),
        \$form.serialize()
    )
    .done(function(result){
      //if new model saved
      if(result == "success")
      {
        $('#modal').modal('hide');
        $.get(\$url+'calendar/event/success',function(data){
          $.each(data,function(key,value){
            {
                $('#calendar').fullCalendar('renderEvent',value,true);
            }
          });
        });
        console.log(result);
      }
      else
      {

      }
    }).fail(function(){
      console.log("server error");
    });
    return false;
  });
JS;

$this->registerJs($script);
