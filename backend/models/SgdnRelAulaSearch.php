<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SgdnRelAula;

/**
 * SgdnRelAulaSearch represents the model behind the search form of `backend\models\SgdnRelAula`.
 */
class SgdnRelAulaSearch extends SgdnRelAula
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'SPOT_ID', 'MODALIDADE_ID', 'INST_MODALIDADE_ID', 'DT_INICIO', 'DT_FIM', 'DT_REGISTO', 'HORA_INICIO', 'HORA_FIM', 'ESTADO', 'DESIG'], 'safe'],
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
        $query = SgdnRelAula::find();

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
            'DT_REGISTO' => $this->DT_REGISTO,
            'PRECO' => $this->PRECO,
        ]);

        $query->andFilterWhere(['like', 'ID', $this->ID])
            ->andFilterWhere(['like', 'SPOT_ID', $this->SPOT_ID])
            ->andFilterWhere(['like', 'MODALIDADE_ID', $this->MODALIDADE_ID])
            // ->andFilterWhere(['like', 'INST_MODALIDADE_ID', $this->INST_MODALIDADE_ID])
            ->andFilterWhere(['like', 'HORA_INICIO', $this->HORA_INICIO])
            ->andFilterWhere(['like', 'HORA_FIM', $this->HORA_FIM])
            ->andFilterWhere(['like', 'ESTADO', $this->ESTADO])
            ->andFilterWhere(['like', 'DESIG', $this->DESIG]);

        return $dataProvider;
    }
}
