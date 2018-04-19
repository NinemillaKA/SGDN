<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SgdnEntidade;

/**
 * SgdnEntidadeSearch represents the model behind the search form of `backend\models\SgdnEntidade`.
 */
class SgdnEntidadeSearch extends SgdnEntidade
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'GLB_GEOGRAFIA_ID', 'CODIGO', 'DESIG', 'URL_LOGO', 'OBS', 'ENDERECO', 'DT_REGISTO', 'ESTADO'], 'safe'],
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
        $query = SgdnEntidade::find();

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
            ->andFilterWhere(['like', 'GLB_GEOGRAFIA_ID', $this->GLB_GEOGRAFIA_ID])
            ->andFilterWhere(['like', 'CODIGO', $this->CODIGO])
            ->andFilterWhere(['like', 'DESIG', $this->DESIG])
            ->andFilterWhere(['like', 'URL_LOGO', $this->URL_LOGO])
            ->andFilterWhere(['like', 'OBS', $this->OBS])
            ->andFilterWhere(['like', 'ENDERECO', $this->ENDERECO])
            ->andFilterWhere(['like', 'ESTADO', $this->ESTADO]);

        return $dataProvider;
    }
}
