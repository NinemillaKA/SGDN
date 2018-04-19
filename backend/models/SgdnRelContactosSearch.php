<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SgdnRelContactos;

/**
 * SgdnRelContactosSearch represents the model behind the search form of `backend\models\SgdnRelContactos`.
 */
class SgdnRelContactosSearch extends SgdnRelContactos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'PR_CONTACTO_TP_ID', 'PESSOA_ID', 'ENTIDADE_ID', 'REL_RESIDENCIA_ID', 'CONTACTO', 'DT_REGISTO', 'ESTADO'], 'safe'],
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
        $query = SgdnRelContactos::find();

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
            ->andFilterWhere(['like', 'PR_CONTACTO_TP_ID', $this->PR_CONTACTO_TP_ID])
            ->andFilterWhere(['like', 'PESSOA_ID', $this->PESSOA_ID])
            ->andFilterWhere(['like', 'ENTIDADE_ID', $this->ENTIDADE_ID])
            ->andFilterWhere(['like', 'REL_RESIDENCIA_ID', $this->REL_RESIDENCIA_ID])
            ->andFilterWhere(['like', 'CONTACTO', $this->CONTACTO])
            ->andFilterWhere(['like', 'ESTADO', $this->ESTADO]);

        return $dataProvider;
    }
}
