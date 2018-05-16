<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SgdnResidencia;

/**
 * SgdnResidenciaSearch represents the model behind the search form of `backend\models\SgdnResidencia`.
 */
class SgdnResidenciaSearch extends SgdnResidencia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'SELF_ID', 'LOCALIDADE_ID', 'DESIG', 'DESCR', 'URL_LOGO', 'ENDERECO', 'DT_REGISTO', 'ESTADO'], 'safe'],
            [['PRECO_DIA', 'VALOR'], 'number'],
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
        $query = SgdnResidencia::find();

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
            'PRECO_DIA' => $this->PRECO_DIA,
            'VALOR' => $this->VALOR,
            'DT_REGISTO' => $this->DT_REGISTO,
        ]);

        $query->andFilterWhere(['like', 'ID', $this->ID])
            ->andFilterWhere(['like', 'SELF_ID', $this->SELF_ID])
            ->andFilterWhere(['like', 'LOCALIDADE_ID', $this->LOCALIDADE_ID])
            ->andFilterWhere(['like', 'DESIG', $this->DESIG])
            ->andFilterWhere(['like', 'DESCR', $this->DESCR])
            ->andFilterWhere(['like', 'URL_LOGO', $this->URL_LOGO])
            ->andFilterWhere(['like', 'ENDERECO', $this->ENDERECO])
            ->andFilterWhere(['like', 'ESTADO', $this->ESTADO]);

        return $dataProvider;
    }
}
