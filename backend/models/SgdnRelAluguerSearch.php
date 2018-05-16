<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SgdnRelAluguer;

/**
 * SgdnRelAluguerSearch represents the model behind the search form of `backend\models\SgdnRelAluguer`.
 */
class SgdnRelAluguerSearch extends SgdnRelAluguer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'PESSOA_ID', 'PRECARIO_ID', 'DT_ALUGUER', 'DT_DEVOLUCAO', 'OBS', 'DT_REGISTO', 'ESTADO'], 'safe'],
            [['VALOR'], 'number'],
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
        $query = SgdnRelAluguer::find();

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
            'DT_ALUGUER' => $this->DT_ALUGUER,
            'DT_DEVOLUCAO' => $this->DT_DEVOLUCAO,
            'VALOR' => $this->VALOR,
            'DT_REGISTO' => $this->DT_REGISTO,
        ]);

        $query->andFilterWhere(['like', 'ID', $this->ID])
            ->andFilterWhere(['like', 'PESSOA_ID', $this->PESSOA_ID])
            ->andFilterWhere(['like', 'PRECARIO_ID', $this->PRECARIO_ID])
            ->andFilterWhere(['like', 'OBS', $this->OBS])
            ->andFilterWhere(['like', 'ESTADO', $this->ESTADO]);

        return $dataProvider;
    }
}
