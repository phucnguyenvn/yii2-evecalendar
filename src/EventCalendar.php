<?php

namespace phucnguyenvn\yii2evecalendar;

class Fullcalendar extends \edofre\fullcalendar\Fullcalendar
{
  public $header = [
		'center' => 'title',
		'left'   => 'prev,next, today',
		'right'  => 'listYear,month,agendaWeek,agendaDay'
	];
}
