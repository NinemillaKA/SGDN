<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SgdnRelAlojamento;

/**
 * SgdnRelAlojamentoSearch represents the model behind the search form of `backend\models\SgdnRelAlojamento`.
 */
class SgdnRelAlojamentoSearch extends SgdnRelAlojamento
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'PESSOA_ID', 'RESIDENCIA_ID', 'OBS', 'DT_ENTRADA', 'DT_SAIDA', 'TOTAL', 'DT_REGISTO', 'ESTADO'], 'safe'],
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
        $query = SgdnRelAlojamento::find();

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
            'DT_ENTRADA' => $this->DT_ENTRADA,
            'DT_SAIDA' => $this->DT_SAIDA,
            'DT_REGISTO' => $this->DT_REGISTO,
        ]);

        $query->andFilterWhere(['like', 'ID', $this->ID])
            ->andFilterWhere(['like', 'PESSOA_ID', $this->PESSOA_ID])
            ->andFilterWhere(['like', 'RESIDENCIA_ID', $this->RESIDENCIA_ID])
            ->andFilterWhere(['like', 'OBS', $this->OBS])
            ->andFilterWhere(['like', 'TOTAL', $this->TOTAL])
            ->andFilterWhere(['like', 'ESTADO', $this->ESTADO]);

        return $dataProvider;
    }
}
