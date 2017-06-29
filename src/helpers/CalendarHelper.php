<?php

namespace phucnguyenvn\yii2evecalendar\helpers;

use phucnguyenvn\yii2evecalendar\models\Event;
use phucnguyenvn\yii2evecalendar\models\DisplayEvents;

class CalendarHelper extends \yii\helpers\BaseArrayHelper
{
    //Convert original event to event of fullCalendar, return a list of array event
    public static function convertCalendar($models)
    {
        $events = array();
        $models = is_array($models)? $models : [$models];
        foreach($models as $model)
        {
          $allDay = (is_null($model->s_time) || is_null($model->e_time));
          $recurr = empty($model->recurrence);
          $event = new DisplayEvents([
               "id" =>$model->id,
               "title"=>$model->title,
               "allDay"=>$allDay,
               "start"=>$model->start,
               "end"=>$model->end,
              //  "url"=>null,
              //  "className"=>null,
              //  "editable"=>false,
              //  "startEditable"=>false,
              //  "durationEditable"=>false,
              //  "rendering"=>null,
               "overlap"=>true,
              //  "constraint"=>null,
              //  "source"=>null,
              //  "color"=>'red',
                "backgroundColor"=>$allDay?'#f0da06':($recurr?'#2f5496':'transparent'),
                "borderColor"=>$recurr?'transparent':'#4472c4',
                "textColor"=>$allDay?'#595959':($recurr?'white':'#595959')
          ]);
          array_push($events,$event);
        }
        return $events;
    }
}
