<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model phucnguyenvn\yii2evecalendar\models\Event */

?>
<div class="event-create">
  <div class="event-form">

      <?php $form = ActiveForm::begin(); ?>

      <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

      <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

      <?= $form->field($model, 'lbnref')->textInput(['maxlength' => true]) ?>

      <?= $form->field($model, 'cat_id')->textInput() ?>

      <?= $form->field($model, 'user_id')->textInput() ?>

      <?= $form->field($model, 's_date')->textInput() ?>

      <?= $form->field($model, 'e_date')->textInput() ?>

      <?= $form->field($model, 's_time')->textInput() ?>

      <?= $form->field($model, 'e_time')->textInput() ?>

      <?= $form->field($model, 'status')->textInput() ?>

      <?= $form->field($model, 'notice_mail')->textInput(['maxlength' => true]) ?>

      <?= $form->field($model, 'recurrence')->textInput(['maxlength' => true]) ?>

      <div class="form-group">
          <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
          <?= Html::button('Cancel', ['class' => 'btn btn-default modal-cancel']) ?>
      </div>

      <?php ActiveForm::end(); ?>

  </div>
</div>
