<?php

namespace phucnguyenvn\yii2evecalendar\models;

use Yii;

/**
 * This is the model class for table "cal_event".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $lbnref
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
            [['cat_id', 'user_id', 'status'], 'integer'],
            [['s_date', 'e_date', 's_time', 'e_time', 'last_run'], 'safe'],
            [['title', 'lbnref', 'notice_mail', 'recurrence'], 'string', 'max' => 255],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => CalCategory::className(), 'targetAttribute' => ['cat_id' => 'id']],
        ];
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
            'lbnref' => 'Lbnref',
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
}
