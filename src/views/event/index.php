<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\web\JsExpression;
use phucnguyenvn\yii2evecalendar\EventCalendar;

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
        'header'=>'<h4>Create event</h4>',
        'id'=>'modal',
        'size'=>'modal-md',
        ]);
      Modal::end();
     ?>
    <?= EventCalendar::widget([
            'events' => \yii\helpers\Url::to(['events', 'id' => 'hihi']),
        ]);
    ?>
