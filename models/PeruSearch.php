<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Peru;

/**
 * PeruSearch represents the model behind the search form about `app\models\Peru`.
 */
class PeruSearch extends Peru
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gid', 'objectid'], 'integer'],
            [['iddist', 'iddpto', 'idprov', 'nombdist', 'nombprov', 'nombdep', 'nom_cap', 'geom'], 'safe'],
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
        $query = Peru::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'gid' => $this->gid,
            'objectid' => $this->objectid,
        ]);

        $query->andFilterWhere(['like', 'iddist', $this->iddist])
            ->andFilterWhere(['like', 'iddpto', $this->iddpto])
            ->andFilterWhere(['like', 'idprov', $this->idprov])
            ->andFilterWhere(['like', 'nombdist', $this->nombdist])
            ->andFilterWhere(['like', 'nombprov', $this->nombprov])
            ->andFilterWhere(['like', 'nombdep', $this->nombdep])
            ->andFilterWhere(['like', 'nom_cap', $this->nom_cap])
            ->andFilterWhere(['like', 'geom', $this->geom]);

        return $dataProvider;
    }
}
