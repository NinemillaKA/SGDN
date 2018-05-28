<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SgdnViagen;

/**
 * SgdnViagenSearch represents the model behind the search form of `backend\models\SgdnViagen`.
 */
class SgdnViagenSearch extends SgdnViagen
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'CODIGO', 'URL_IMAGEM', 'DESIG', 'DESCR', 'GEOGRAFIA_ID', 'ENDERECO', 'DT_INICIO', 'DT_FIM', 'DT_REGISTO', 'ESTADO'], 'safe'],
            [['PRECO'], 'number'],
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
        $query = SgdnViagen::find();

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
            'DT_INICIO' => $this->DT_INICIO,
            'DT_FIM' => $this->DT_FIM,
            'PRECO' => $this->PRECO,
            'DT_REGISTO' => $this->DT_REGISTO,
        ]);

        $query->andFilterWhere(['like', 'ID', $this->ID])
            ->andFilterWhere(['like', 'CODIGO', $this->CODIGO])
            ->andFilterWhere(['like', 'URL_IMAGEM', $this->URL_IMAGEM])
            ->andFilterWhere(['like', 'DESIG', $this->DESIG])
            ->andFilterWhere(['like', 'DESCR', $this->DESCR])
            ->andFilterWhere(['like', 'GEOGRAFIA_ID', $this->GEOGRAFIA_ID])
            ->andFilterWhere(['like', 'ENDERECO', $this->ENDERECO])
            ->andFilterWhere(['like', 'ESTADO', $this->ESTADO]);

        return $dataProvider;
    }
}
