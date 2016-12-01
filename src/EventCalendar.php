<?php

namespace phucnguyenvn\yii2evecalendar;

class EventCalendar extends \edofre\fullcalendar\Fullcalendar
{
  public $header = [
		'center' => 'title',
		'left'   => 'prev,next, today',
		'right'  => 'listYear,month,agendaWeek,agendaDay'
	];
	
  public function run()
  {
    assets\ModuleAsset::register($this->view);
    return parent::run();
  }
}
