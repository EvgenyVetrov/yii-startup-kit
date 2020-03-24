<?php

namespace modules\users\models\backend;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\users\models\backend\Profiles;

/**
 * SearchProfiles represents the model behind the search form of `modules\users\models\backend\Profiles`.
 */
class SearchProfiles extends Profiles
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'org_id', 'invite_date', 'invite_user', 'created_at', 'updated_at'], 'integer'],
            [['json_contacts', 'custom_contacts', 'role', 'position', 'invite_status', 'status', 'own_description'], 'safe'],
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
        $query = Profiles::find();

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
            'invite_date' => $this->invite_date,
            'invite_user' => $this->invite_user,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'json_contacts', $this->json_contacts])
            ->andFilterWhere(['like', 'custom_contacts', $this->custom_contacts])
            ->andFilterWhere(['like', 'role', $this->role])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'invite_status', $this->invite_status])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'own_description', $this->own_description]);

        return $dataProvider;
    }
}
