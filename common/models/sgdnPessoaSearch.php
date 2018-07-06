<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\sgdnPessoa;

/**
 * sgdnPessoaSearch represents the model behind the search form of `backend\models\sgdnPessoa`.
 */
class sgdnPessoaSearch extends sgdnPessoa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'NATURALIDADE_ID', 'LOCALIDADE_ID', 'PR_ESTADO_CIVIL_ID', 'NOME', 'DT_NASC', 'SEXO', 'MORADA', 'URL_FOTO', 'DT_REGISTO', 'ESTADO', 'SGDN_PESSOA_ID'], 'safe'],
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
        $query = sgdnPessoa::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [ 'pageSize' => 10 ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'DT_NASC' => $this->DT_NASC,
            'DT_REGISTO' => $this->DT_REGISTO,
        ]);

        $query->andFilterWhere(['like', 'ID', $this->ID])
            ->andFilterWhere(['like', 'NATURALIDADE_ID', $this->NATURALIDADE_ID])
            ->andFilterWhere(['like', 'LOCALIDADE_ID', $this->LOCALIDADE_ID])
            ->andFilterWhere(['like', 'PR_ESTADO_CIVIL_ID', $this->PR_ESTADO_CIVIL_ID])
            ->andFilterWhere(['like', 'NOME', $this->NOME])
            ->andFilterWhere(['like', 'SEXO', $this->SEXO])
            ->andFilterWhere(['like', 'MORADA', $this->MORADA])
            ->andFilterWhere(['like', 'URL_FOTO', $this->URL_FOTO])
            ->andFilterWhere(['like', 'ESTADO', $this->ESTADO])
            ->andFilterWhere(['like', 'SGDN_PESSOA_ID', $this->SGDN_PESSOA_ID]);

        return $dataProvider;
    }
}
