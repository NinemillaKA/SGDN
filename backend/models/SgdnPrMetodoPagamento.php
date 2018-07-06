<?php

namespace backend\models;

use Yii;
use \Faker\Provider\Uuid;

/**
 * This is the model class for table "sgdn_pr_metodo_pagamento".
 *
 * @property string $ID
 * @property string $CODIGO
 * @property string $DESIG
 * @property string $DESCR
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdnRelMatricula[] $sgdnRelMatriculas
 */
class SgdnPrMetodoPagamento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_pr_metodo_pagamento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CODIGO', 'DESIG',], 'required'],
            [['DT_REGISTO'], 'safe'],
            [['ID'], 'string', 'max' => 36],
            [['CODIGO'], 'string', 'max' => 5],
            [['DESIG'], 'string', 'max' => 250],
            [['DESCR'], 'string', 'max' => 2000],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'CODIGO' => 'Codigo',
            'DESIG' => 'Desig',
            'DESCR' => 'Descr',
            'DT_REGISTO' => 'Dt  Registo',
            'ESTADO' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelMatriculas()
    {
        return $this->hasMany(SgdnRelMatricula::className(), ['METD_PGMENT_ID' => 'ID']);
    }

    public function beforeSave($insert)
    {
        if ($insert) {
          $this->ID = Uuid::uuid();
          $this->DT_REGISTO = date('Y-m-d h:m:s');
          $this->ESTADO = 'A';

            return true;
         }

        return parent::beforeSave($insert);
    }

}
