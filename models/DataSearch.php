<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Data;

/**
 * DataSearch represents the model behind the search form about `app\models\Data`.
 */
class DataSearch extends Data
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gid', 'objectid'], 'integer'],
            [['iddist', 'iddpto', 'idprov', 'nombdist', 'nombprov', 'nombdep', 'nom_cap', 'periodo'], 'safe'],
            [['PIA', 'PIM'], 'number'],
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
        $query = Data::find();

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
            'PIA' => $this->PIA,
            'PIM' => $this->PIM,
        ]);

        $query->andFilterWhere(['like', 'iddist', $this->iddist])
            ->andFilterWhere(['like', 'iddpto', $this->iddpto])
            ->andFilterWhere(['like', 'idprov', $this->idprov])
            ->andFilterWhere(['like', 'nombdist', $this->nombdist])
            ->andFilterWhere(['like', 'nombprov', $this->nombprov])
            ->andFilterWhere(['like', 'nombdep', $this->nombdep])
            ->andFilterWhere(['like', 'nom_cap', $this->nom_cap])
            ->andFilterWhere(['like', 'periodo', $this->periodo]);

        return $dataProvider;
    }
}
