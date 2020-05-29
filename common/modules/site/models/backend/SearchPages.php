<?php

namespace modules\site\models\backend;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\site\models\backend\Pages;

/**
 * SearchPages represents the model behind the search form of `modules\site\models\backend\Pages`.
 */
class SearchPages extends Pages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'location', 'content', 'js', 'custom_head', 'robots', 'keywords', 'description', 'title', 'blocks_ids', 'sitemap_lastmod', 'sitemap_changefreq', 'sitemap_priority', 'type', 'own_description', 'status'], 'safe'],
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
        $query = Pages::find();

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
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'js', $this->js])
            ->andFilterWhere(['like', 'custom_head', $this->custom_head])
            ->andFilterWhere(['like', 'robots', $this->robots])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'blocks_ids', $this->blocks_ids])
            ->andFilterWhere(['like', 'sitemap_lastmod', $this->sitemap_lastmod])
            ->andFilterWhere(['like', 'sitemap_changefreq', $this->sitemap_changefreq])
            ->andFilterWhere(['like', 'sitemap_priority', $this->sitemap_priority])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'own_description', $this->own_description])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
