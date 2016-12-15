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

    <?= $form->field($model, 'cat_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'entity_id')->textInput() ?>

    <?= $form->field($model, 'notice_mail')->textInput(['maxlength' => true]) ?>
    <div class="row">
      <div class="col-sm-4">
      <?= $form->field($model, 's_date')->widget(\yii\jui\DatePicker::classname(), [
                'dateFormat' => 'yyyy-MM-dd',
                'options' => [
                      'class'=>'form-control',
                   ]
            ])?>
      </div>
      <div class="col-sm-4">
        <?= $form->field($model, 's_time')->widget(\kartik\time\TimePicker::classname(), [

        ]) ?>
      </div>

      <div class="col-sm-4 text-center">
        <div class="form-group field-all-day">
          <label class="control-label" style="padding-top:30px;"><input type="checkbox" id="all-day" <?php if((!$model->isNewRecord&&is_null($model->s_time))||(!$model->isNewRecord&&is_null($model->e_time))) echo 'checked'; ?>><span style="padding-left:5px;">All day</span></label>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <?= $form->field($model, 'e_date')->widget(\yii\jui\DatePicker::classname(), [
                  'dateFormat' => 'yyyy-MM-dd',
                  'options' => [
                        'class'=>'form-control',
                     ]
              ])?>
      </div>

      <div class="col-sm-4">
        <?= $form->field($model, 'e_time')->widget(\kartik\time\TimePicker::classname(), [
            'pluginOptions' => [
              'defaultTime' => false
            ]
        ]) ?>
      </div>

    </div>
    <?= $form->field($model, 'status')->textInput() ?>

    <?= $this->render('_recurrent') ?>

    <?= $form->field($model, 'recurrence')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::button('Cancel', ['class' => 'btn btn-default modal-cancel']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
