<?php

namespace modules\main\models\backend;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\main\models\TasksLogs;

/**
 * SearchTasksLogs represents the model behind the search form of `modules\main\models\TasksLogs`.
 */
class SearchTasksLogs extends TasksLogs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'task', 'processed_counter', 'success_counter', 'previous_log_offset', 'task_start_at', 'created_at'], 'integer'],
            [['data', 'status', 'initiator'], 'safe'],
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
        $query = TasksLogs::find();

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
            'task' => $this->task,
            'processed_counter' => $this->processed_counter,
            'success_counter' => $this->success_counter,
            'previous_log_offset' => $this->previous_log_offset,
            'task_start_at' => $this->task_start_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'data', $this->data])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'initiator', $this->initiator]);

        return $dataProvider;
    }
}
