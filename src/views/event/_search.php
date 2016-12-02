<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model phucnguyenvn\yii2evecalendar\models\EventSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'lbnref') ?>

    <?= $form->field($model, 'cat_id') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'notice_mail') ?>

    <?php // echo $form->field($model, 's_date') ?>

    <?php // echo $form->field($model, 'e_date') ?>

    <?php // echo $form->field($model, 's_time') ?>

    <?php // echo $form->field($model, 'e_time') ?>

    <?php // echo $form->field($model, 'last_run') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'recurrence') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
