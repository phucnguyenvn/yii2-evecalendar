<?php

namespace phucnguyenvn\yii2evecalendar\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use phucnguyenvn\yii2evecalendar\models\Event;

/**
 * EventSearch represents the model behind the search form about `phucnguyenvn\yii2evecalendar\models\Event`.
 */
class EventSearch extends Event
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cat_id', 'user_id', 'status','entity_id'], 'integer'],
            [['title', 'description', 'notice_mail', 's_date', 'e_date', 's_time', 'e_time', 'last_run', 'recurrence'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Event::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'cat_id' => $this->cat_id,
            'user_id' => $this->user_id,
            'entity_id' => $this->entity_id,
            's_date' => $this->s_date,
            'e_date' => $this->e_date,
            's_time' => $this->s_time,
            'e_time' => $this->e_time,
            'last_run' => $this->last_run,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'notice_mail', $this->notice_mail])
            ->andFilterWhere(['like', 'recurrence', $this->recurrence]);

        return $dataProvider;
    }
}
