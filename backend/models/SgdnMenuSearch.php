<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SgdnMenu;

/**
 * SgdnMenuSearch represents the model behind the search form of `backend\models\SgdnMenu`.
 */
class SgdnMenuSearch extends SgdnMenu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'DESIG', 'DESCR', 'CONTROLLER', 'ESTADO', 'DT_REGISTO', 'DT_UPDATE', 'ACTION'], 'safe'],
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
        $query = SgdnMenu::find();

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
            'DT_UPDATE' => $this->DT_UPDATE,
        ]);

        $query->andFilterWhere(['like', 'ID', $this->ID])
            ->andFilterWhere(['like', 'DESIG', $this->DESIG])
            ->andFilterWhere(['like', 'DESCR', $this->DESCR])
            ->andFilterWhere(['like', 'CONTROLLER', $this->CONTROLLER])
            ->andFilterWhere(['like', 'ESTADO', $this->ESTADO])
            ->andFilterWhere(['like', 'ACTION', $this->ACTION]);

        return $dataProvider;
    }
}
