<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SgdnMaterial;

/**
 * SgdnMaterialSearch represents the model behind the search form of `backend\models\SgdnMaterial`.
 */
class SgdnMaterialSearch extends SgdnMaterial
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'MATERIAL_TP_ID', 'CODIGO', 'DESIG', 'URL_LOGO', 'DESCR', 'DT_REGISTO', 'ESTADO'], 'safe'],
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
        $query = SgdnMaterial::find();

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
            ->andFilterWhere(['like', 'MATERIAL_TP_ID', $this->MATERIAL_TP_ID])
            ->andFilterWhere(['like', 'CODIGO', $this->CODIGO])
            ->andFilterWhere(['like', 'DESIG', $this->DESIG])
            ->andFilterWhere(['like', 'URL_LOGO', $this->URL_LOGO])
            ->andFilterWhere(['like', 'DESCR', $this->DESCR])
            ->andFilterWhere(['like', 'ESTADO', $this->ESTADO]);

        return $dataProvider;
    }
}
