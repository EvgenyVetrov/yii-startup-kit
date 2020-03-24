<?php

namespace modules\sitemap\models\backend;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\sitemap\models\backend\Sitemap;

/**
 * SearchSitemap represents the model behind the search form of `modules\sitemap\models\backend\Sitemap`.
 */
class SearchSitemap extends Sitemap
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'loc', 'lastmod', 'changefreq', 'priority', 'own_description', 'status'], 'safe'],
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
        $query = Sitemap::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'loc', $this->loc])
            ->andFilterWhere(['like', 'lastmod', $this->lastmod])
            ->andFilterWhere(['like', 'changefreq', $this->changefreq])
            ->andFilterWhere(['like', 'priority', $this->priority])
            ->andFilterWhere(['like', 'own_description', $this->own_description])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
