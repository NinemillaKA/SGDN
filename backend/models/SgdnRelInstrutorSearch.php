<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SgdnRelInstrutorModalidade;

/**
 * SgdnRelInstrutorSearch represents the model behind the search form of `backend\models\SgdnRelInstrutorModalidade`.
 */
class SgdnRelInstrutorSearch extends SgdnRelInstrutorModalidade
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'PR_MODALIDADE_ID', 'INSTRUTOR_ID', 'DATA', 'OBS', 'DT_REGISTO', 'ESTADO'], 'safe'],
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
        $query = SgdnRelInstrutorModalidade::find();

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
            ->andFilterWhere(['like', 'PR_MODALIDADE_ID', $this->PR_MODALIDADE_ID])
            ->andFilterWhere(['like', 'INSTRUTOR_ID', $this->INSTRUTOR_ID])
            ->andFilterWhere(['like', 'OBS', $this->OBS])
            ->andFilterWhere(['like', 'ESTADO', $this->ESTADO]);

        return $dataProvider;
    }
}
