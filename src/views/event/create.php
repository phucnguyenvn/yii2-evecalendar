<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model phucnguyenvn\yii2evecalendar\models\Event */

?>
<div class="event-create">

  <div class="event-form">

      <?php $form = ActiveForm::begin(['id'=>'event-form']); ?>
      <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

      <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

      <?= $form->field($model, 'cat_id')->textInput() ?>

      <?= $form->field($model, 'user_id')->textInput() ?>

      <?= $form->field($model, 'entity_id')->textInput() ?>

      <?= $form->field($model, 'notice_mail')->textInput(['maxlength' => true]) ?>

      <div class="col-sm-6">
      <?= $form->field($model, 's_date')->widget(\yii\jui\DatePicker::classname(), [
                'dateFormat' => 'yyyy-MM-dd',
                'options' => [
                      'class'=>'form-control',
                   ]
            ])?>
      </div>
      <div class="col-sm-6">
        <?= $form->field($model, 's_time')->widget(\kartik\time\TimePicker::classname(), [

        ]) ?>
      </div>

      <div class="col-sm-6">
        <?= $form->field($model, 'e_date')->widget(\yii\jui\DatePicker::classname(), [
                  'dateFormat' => 'yyyy-MM-dd',
                  'options' => [
                        'class'=>'form-control',
                     ]
              ])?>
      </div>

      <div class="col-sm-6">
        <?= $form->field($model, 'e_time')->widget(\kartik\time\TimePicker::classname(), [
            'pluginOptions' => [
              'defaultTime' => false
            ]
        ]) ?>
      </div>

      <?= $form->field($model, 'status')->textInput() ?>

      <?= $form->field($model, 'recurrence')->textInput(['maxlength' => true]) ?>

      <div class="form-group">
          <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
      </div>

      <?php ActiveForm::end(); ?>

  </div>

</div>
<?php
  //hanled ajax submit form
  $script = <<< JS
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
              $('#calendar').fullCalendar('renderEvent',value,true);
          }
        });

      }
      else
      {
        return false;
      }
    }).fail(function(){
      console.log("server error");
    });
    return false;
  });
JS;

$this->registerJs($script);
