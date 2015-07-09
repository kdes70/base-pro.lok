<?php

namespace app\modules\dish\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\dish\models\Dishs;

/**
 * DishsSearch represents the model behind the search form about `app\modules\dish\models\Dishs`.
 */
class DishsSearch extends Dishs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'menu_id', 'weight', 'status', 'order'], 'integer'],
            [['name', 'alias', 'description', 'value', 'img'], 'safe'],
            [['price'], 'number'],
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
        $query = Dishs::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'menu_id' => $this->menu_id,
            'weight' => $this->weight,
            'price' => $this->price,
            'status' => $this->status,
            'order' => $this->order,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'img', $this->img]);

        return $dataProvider;
    }
}
