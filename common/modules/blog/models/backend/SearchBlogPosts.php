<?php

namespace modules\blog\models\backend;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\blog\models\backend\BlogPosts;

/**
 * SearchBlogPosts represents the model behind the search form of `modules\blog\models\backend\BlogPosts`.
 */
class SearchBlogPosts extends BlogPosts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'creation_date', 'publication_date', 'author_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'bg_image', 'general_image', 'alt_image', 'announce', 'text', 'category_id', 'seo_keywords', 'seo_description', 'canonical_url', 'status', 'own_description'], 'safe'],
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
        $query = BlogPosts::find();

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
            'creation_date' => $this->creation_date,
            'publication_date' => $this->publication_date,
            'author_id' => $this->author_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'bg_image', $this->bg_image])
            ->andFilterWhere(['like', 'general_image', $this->general_image])
            ->andFilterWhere(['like', 'alt_image', $this->alt_image])
            ->andFilterWhere(['like', 'announce', $this->announce])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'category_id', $this->category_id])
            ->andFilterWhere(['like', 'seo_keywords', $this->seo_keywords])
            ->andFilterWhere(['like', 'seo_description', $this->seo_description])
            ->andFilterWhere(['like', 'canonical_url', $this->canonical_url])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'own_description', $this->own_description]);

        return $dataProvider;
    }
}
