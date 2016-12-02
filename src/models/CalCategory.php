<?php

namespace phucnguyenvn\yii2evecalendar\models;

use Yii;

/**
 * This is the model class for table "cal_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $color
 * @property string $bg_color
 *
 * @property CalEvent[] $calEvents
 */
class CalCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cal_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['name', 'color', 'bg_color'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'color' => 'Color',
            'bg_color' => 'Bg Color',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalEvents()
    {
        return $this->hasMany(CalEvent::className(), ['cat_id' => 'id']);
    }
}
