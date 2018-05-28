<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SgdnRelInscricaoViagen;

/**
 * SgdnRelInscricaoViagenSearch represents the model behind the search form of `backend\models\SgdnRelInscricaoViagen`.
 */
class SgdnRelInscricaoViagenSearch extends SgdnRelInscricaoViagen
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'VIAGEM_ID', 'PESSOA_ID', 'INSTRUTOR_ID', 'DATA', 'DT_REGISTO', 'ESTADO'], 'safe'],
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
        $query = SgdnRelInscricaoViagen::find();

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
            'DATA' => $this->DATA,
            'DT_REGISTO' => $this->DT_REGISTO,
        ]);

        $query->andFilterWhere(['like', 'ID', $this->ID])
            ->andFilterWhere(['like', 'VIAGEM_ID', $this->VIAGEM_ID])
            ->andFilterWhere(['like', 'PESSOA_ID', $this->PESSOA_ID])
            // ->andFilterWhere(['like', 'INSTRUTOR_ID', $this->PESSOA_ID])
            ->andFilterWhere(['like', 'ESTADO', $this->ESTADO]);

        return $dataProvider;
    }
}
