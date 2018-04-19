<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SgdnRelPrecario;

/**
 * SgdnRelPrecarioSearch represents the model behind the search form of `backend\models\SgdnRelPrecario`.
 */
class SgdnRelPrecarioSearch extends SgdnRelPrecario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'REL_AULA_ID', 'REL_MATERIAL_MODALIDADE_ID', 'OBS', 'DT_REGISTO', 'ESTADO'], 'safe'],
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
        $query = SgdnRelPrecario::find();

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
            'PRECO' => $this->PRECO,
            'DT_REGISTO' => $this->DT_REGISTO,
        ]);

        $query->andFilterWhere(['like', 'ID', $this->ID])
            ->andFilterWhere(['like', 'REL_AULA_ID', $this->REL_AULA_ID])
            ->andFilterWhere(['like', 'REL_MATERIAL_MODALIDADE_ID', $this->REL_MATERIAL_MODALIDADE_ID])
            ->andFilterWhere(['like', 'OBS', $this->OBS])
            ->andFilterWhere(['like', 'ESTADO', $this->ESTADO]);

        return $dataProvider;
    }
}
