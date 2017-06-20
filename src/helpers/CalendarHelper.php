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
          $event = new DisplayEvents([
               "id" =>$model->id,
               "title"=>$model->title,
               "allDay"=>(is_null($model->s_time) || is_null($model->e_time)),
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
                "backgroundColor"=>empty($model->recurrence)?'#ffff0b':'#03fbfa',
                "borderColor"=>(is_null($model->s_time) || is_null($model->e_time))?'transparent':'#1ea421',
                "textColor"=>(is_null($model->s_time) || is_null($model->e_time))?'#ff2e00':'#112981'
          ]);
          array_push($events,$event);
        }
        return $events;
    }
}
