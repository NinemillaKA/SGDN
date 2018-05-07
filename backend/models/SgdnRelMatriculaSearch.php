<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SgdnRelMatricula;

/**
 * SgdnRelMatriculaSearch represents the model behind the search form of `backend\models\SgdnRelMatricula`.
 */
class SgdnRelMatriculaSearch extends SgdnRelMatricula
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'ALUNO_ID', 'AULA_ID', 'CODIGO', 'DATA', 'OBS', 'DT_REGISTO', 'ESTADO'], 'safe'],
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
        $query = SgdnRelMatricula::find();

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
            'PRECO' => $this->PRECO,
        ]);

        $query->andFilterWhere(['like', 'ID', $this->ID])
            ->andFilterWhere(['like', 'ALUNO_ID', $this->ALUNO_ID])
            ->andFilterWhere(['like', 'AULA_ID', $this->AULA_ID])
            ->andFilterWhere(['like', 'CODIGO', $this->CODIGO])
            ->andFilterWhere(['like', 'OBS', $this->OBS])
            ->andFilterWhere(['like', 'ESTADO', $this->ESTADO]);

        return $dataProvider;
    }
}
