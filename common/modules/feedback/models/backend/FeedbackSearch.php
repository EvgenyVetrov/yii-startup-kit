<?php

namespace modules\feedback\models\backend;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\feedback\models\backend\Feedback;

/**
 * FeedbackSearch represents the model behind the search form of `modules\feedback\models\backend\Feedback`.
 */
class FeedbackSearch extends Feedback
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'org_id', 'type', 'object', 'object_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['email', 'text', 'ip', 'user_agent', 'device_info', 'own_description'], 'safe'],
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
        $query = Feedback::find();

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
            'user_id' => $this->user_id,
            'org_id' => $this->org_id,
            'type' => $this->type,
            'object' => $this->object,
            'object_id' => $this->object_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'user_agent', $this->user_agent])
            ->andFilterWhere(['like', 'device_info', $this->device_info])
            ->andFilterWhere(['like', 'own_description', $this->own_description]);

        return $dataProvider;
    }
}
