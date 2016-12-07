<?php

namespace phucnguyenvn\yii2evecalendar\models;

use Yii;

use yii\helpers\ArrayHelper;

use yii\validators\DateValidator;

/**
 * This is the model class for table "cal_event".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $entity_id
 * @property integer $cat_id
 * @property integer $user_id
 * @property string $notice_mail
 * @property string $s_date
 * @property string $e_date
 * @property string $s_time
 * @property string $e_time
 * @property string $last_run
 * @property integer $status
 * @property string $recurrence
 *
 * @property CalCategory $cat
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cal_event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],
            [['cat_id', 'user_id', 'status','entity_id'], 'integer'],
            [['s_time', 'e_time'], 'safe'],
            [['s_date', 'e_date'], 'date'],
            [['title', 'notice_mail', 'recurrence'], 'string', 'max' => 255],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => CalCategory::className(), 'targetAttribute' => ['cat_id' => 'id']],
        ];
    }

    //Return array of event between specific start and end time input
    //Main purpose only for calendar display
    public static function getEventbyDateRange($start,$end)
    {
      //non-recurrent events
      $non_recurrent = Event::find()
      ->where(['>=','s_date', $start])
      //->andWhere(['=','status', 1])
      ->andWhere(['=','recurrence', ''])
      ->andWhere(['or',['<=','e_date', $end],['is','e_date', null]])
      ->all();

      //recurring events
      $recurrent_model = Event::find()
      ->where(['!=','recurrence', ''])
      ->all();

      $recurrent = array();
      foreach($recurrent_model as $model_item)
      {
        $transformer = new \Recurr\Transformer\ArrayTransformer();
        $constraint  = new \Recurr\Transformer\Constraint\BetweenConstraint(new \DateTime($start),new \DateTime($end),Yii::$app->timeZone);
        $rule        = new \Recurr\Rule($model_item->recurrence,$startDate=null, $endDate=null, Yii::$app->timeZone);
        $recurrent_collection = $transformer->transform($rule, $constraint);

        //clone original event base on recurr logic
        foreach($recurrent_collection as $item)
        {
          $recurring_item = new Event;//clone original event
          $recurring_item->attributes = $model_item->attributes;
          $recurring_item->s_date = date_format($item->getStart(),"Y-m-d"); //set new start date
          $recurring_item->e_date = date_format($item->getEnd(),"Y-m-d"); //set new end date
          array_push($recurrent,$recurring_item);
        }
      }
      $result = ArrayHelper::merge($non_recurrent,$recurrent);
      return $result;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'entity_id' => 'Entity',
            'cat_id' => 'Cat ID',
            'user_id' => 'User ID',
            'notice_mail' => 'Notice Mail',
            's_date' => 'Start Date',
            'e_date' => 'End Date',
            's_time' => 'Start Time',
            'e_time' => 'End Time',
            'last_run' => 'Last Run',
            'status' => 'Status',
            'recurrence' => 'Recurrence',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(CalCategory::className(), ['id' => 'cat_id']);
    }

    //return start datetime ISO8601 string combine by start date and start time
    public function getStart()
    {
        $startdate = date(DATE_ISO8601, strtotime($this->s_date." ".$this->s_time));
        return $startdate;
    }

    //return end datetime ISO8601 string combine by end date and end time
    public function getEnd()
    {
      //check if this event is allDay, return null
      if(is_null($this->e_date) && is_null($this->e_time)) return null;
      $enddate = date(DATE_ISO8601, strtotime($this->e_date." ".$this->e_time));
      return $enddate;
    }
}
