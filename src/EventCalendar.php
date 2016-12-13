<?php

namespace phucnguyenvn\yii2evecalendar;

class EventCalendar extends \edofre\fullcalendar\Fullcalendar
{
  public $header = [
		'center' => 'title',
		'left'   => 'prev,next, today',
		'right'  => 'listWeek,month,agendaWeek,agendaDay'
	];

  //allow event limit display
  public $eventLimit = true;

  public $navLinks  = true;

  public $nowIndicator = true;

  public $views = [
        'agenda' => ['eventLimit' => 5],// adjust to 5 only for agendaWeek/agendaDay
    ];

  public function run()
  {
    $this->clientOptions['nowIndicator'] = $this->nowIndicator;
    $this->clientOptions['navLinks'] = $this->navLinks;
    $this->clientOptions['views'] = $this->views;
    $this->clientOptions['eventLimit'] = $this->eventLimit;
    assets\ModuleAsset::register($this->view);
    return parent::run();
  }

}
