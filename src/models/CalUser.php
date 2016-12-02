<?php

namespace phucnguyenvn\yii2evecalendar\models;

use Yii;

/**
 * This is the model class for table "cal_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property integer $status
 *
 * @property CalEvent[] $calEvents
 */
class CalUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cal_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username'], 'required'],
            [['status'], 'integer'],
            [['username', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalEvents()
    {
        return $this->hasMany(CalEvent::className(), ['user_id' => 'id']);
    }
}
