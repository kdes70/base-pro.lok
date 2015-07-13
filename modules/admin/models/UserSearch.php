<?php

    namespace app\modules\admin\models;

    use Yii;
    use yii\base\Model;
    use yii\data\ActiveDataProvider;
    use yii\helpers\ArrayHelper;

    /**
     * UserSearch represents the model behind the search form about `app\modules\admin\models\User`.
     */
    class UserSearch extends User
    {
        public $date_from;
        public $date_to;

        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
                [['id', 'status'], 'integer'],
                [['username', 'email'], 'safe'],
                [['date_from', 'date_to'], 'date', 'format' => 'Y-m-d'],
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
         * @inheritdoc
         */
        public function attributeLabels()
        {
            return ArrayHelper::merge(parent::attributeLabels(), [
                'date_from' => '���� �',
                'date_to' => '���� ��',
            ]);
        }

        /**
         * Creates data provider instance with search query applied
         * @param array $params
         * @return ActiveDataProvider
         */
        public function search($params)
        {
            $query = User::find();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'sort' => [
                    'defaultOrder' => ['id' => SORT_DESC],
                ]
            ]);

            $this->load($params);

            if (!$this->validate()) {
                $query->where('0=1');
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id' => $this->id,
                'status' => $this->status,
            ]);

            $query
                ->andFilterWhere(['like', 'username', $this->username])
                ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['>=', 'created_at', $this->date_from ? strtotime($this->date_from . ' 00:00:00') : null])
                ->andFilterWhere(['<=', 'created_at', $this->date_to ? strtotime($this->date_to . ' 23:59:59') : null]);

            return $dataProvider;
        }
    }