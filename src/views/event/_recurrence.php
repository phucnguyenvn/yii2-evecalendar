<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model phucnguyenvn\yii2evecalendar\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="form-group">
  <label class="control-label">Repeat?</label>
  <label><input type="radio" name="event-recurring" value="no" checked/>No</label>
  <label><input type="radio" name="event-recurring" value="yes" />Yes</label>
</div>
<div id="recurring-rules">
  <div class="row">
    <div class="form-group col-sm-12">
      <label class="control-label"><input type="radio" name="repeat-type"/>Repeat every:</label>
      <input type="text" name="interval" value="1" size="2"/>
      <select name="freq">
        <option value="daily"class="days">Day(s)</option>
        <option value="weekly" class="weeks">Week(s)</option>
        <option value="monthly" class="months">Month(s)</option>
        <option value="yearly" class="years">Year(s)</option>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm-12">
      <label class="control-label"><input type="radio" name="repeat-type"/>Repeat every:</label>
      <select name="yearly-bysetpos" class="yearly-precise">
            <option value="1" selected="selected">First</option>
            <option value="2">Second</option>
            <option value="3">Third</option>
            <option value="4">Fourth</option>
            <option value="-1">Last</option>
      </select>
    </div>
  </div>
</div>

<?php
  //hanled ajax submit form
  $script = <<< JS
  $('#event-recurring').change(function(){

  	// Resets all the recurring options
  	//resetOptions();

  	// enable the input next to the selected radio button
  	if( $(this).val() == "yes" ){
  		$('input[name=recurring-rules]').slideDown();

  		// Show Until Rules
  		//$('#until-rules').show();

  	} else {
  		//disable the inputs not selected.
  		$('#recurring-rules').hide();
  	}

  });

JS;

$this->registerJs($script);
