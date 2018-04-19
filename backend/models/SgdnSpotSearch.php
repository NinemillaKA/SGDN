<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SgdnSpot;

/**
 * SgdnSpotSearch represents the model behind the search form of `backend\models\SgdnSpot`.
 */
class SgdnSpotSearch extends SgdnSpot
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'GEOGRAFIA_ID', 'CODIGO', 'DESIG', 'DESCR', 'URL_IMAGEM', 'DT_REGISTO', 'ESTADO'], 'safe'],
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
        $query = SgdnSpot::find();

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
            'DT_REGISTO' => $this->DT_REGISTO,
        ]);

        $query->andFilterWhere(['like', 'ID', $this->ID])
            ->andFilterWhere(['like', 'GEOGRAFIA_ID', $this->GEOGRAFIA_ID])
            ->andFilterWhere(['like', 'CODIGO', $this->CODIGO])
            ->andFilterWhere(['like', 'DESIG', $this->DESIG])
            ->andFilterWhere(['like', 'DESCR', $this->DESCR])
            ->andFilterWhere(['like', 'URL_IMAGEM', $this->URL_IMAGEM])
            ->andFilterWhere(['like', 'ESTADO', $this->ESTADO]);

        return $dataProvider;
    }
}