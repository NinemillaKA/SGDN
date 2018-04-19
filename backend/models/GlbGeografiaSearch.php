<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\GlbGeografia;

/**
 * GlbGeografiaSearch represents the model behind the search form of `backend\models\GlbGeografia`.
 */
class GlbGeografiaSearch extends GlbGeografia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'NOME', 'ZONA', 'FREGUESIA', 'CONCELHO', 'ILHA', 'PAIS', 'GLB_GEOGRAFIA_ID', 'NIVEL_DETALHE', 'NACIONALIDADE', 'NOME_OFICIAL', 'FLAG_ALTER', 'NOME_NORM', 'TP_GEOG_CD', 'FLG_SITUACAO', 'CODIGO_INE', 'CODIGO'], 'safe'],
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
        $query = GlbGeografia::find();

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
        $query->andFilterWhere(['like', 'ID', $this->ID])
            ->andFilterWhere(['like', 'NOME', $this->NOME])
            ->andFilterWhere(['like', 'ZONA', $this->ZONA])
            ->andFilterWhere(['like', 'FREGUESIA', $this->FREGUESIA])
            ->andFilterWhere(['like', 'CONCELHO', $this->CONCELHO])
            ->andFilterWhere(['like', 'ILHA', $this->ILHA])
            ->andFilterWhere(['like', 'PAIS', $this->PAIS])
            ->andFilterWhere(['like', 'GLB_GEOGRAFIA_ID', $this->GLB_GEOGRAFIA_ID])
            ->andFilterWhere(['like', 'NIVEL_DETALHE', $this->NIVEL_DETALHE])
            ->andFilterWhere(['like', 'NACIONALIDADE', $this->NACIONALIDADE])
            ->andFilterWhere(['like', 'NOME_OFICIAL', $this->NOME_OFICIAL])
            ->andFilterWhere(['like', 'FLAG_ALTER', $this->FLAG_ALTER])
            ->andFilterWhere(['like', 'NOME_NORM', $this->NOME_NORM])
            ->andFilterWhere(['like', 'TP_GEOG_CD', $this->TP_GEOG_CD])
            ->andFilterWhere(['like', 'FLG_SITUACAO', $this->FLG_SITUACAO])
            ->andFilterWhere(['like', 'CODIGO_INE', $this->CODIGO_INE])
            ->andFilterWhere(['like', 'CODIGO', $this->CODIGO]);

        return $dataProvider;
    }
}
