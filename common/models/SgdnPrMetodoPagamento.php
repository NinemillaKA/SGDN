<?php

namespace common\models;

use Yii;

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
 * @property SgdnRelAlojamento[] $sgdnRelAlojamentos
 * @property SgdnRelAluguer[] $sgdnRelAluguers
 * @property SgdnRelInscricaoViagen[] $sgdnRelInscricaoViagens
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
            [['ID', 'CODIGO', 'DESIG', 'DT_REGISTO', 'ESTADO'], 'required'],
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
    public function getSgdnRelAlojamentos()
    {
        return $this->hasMany(SgdnRelAlojamento::className(), ['METD_PGMENT_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelAluguers()
    {
        return $this->hasMany(SgdnRelAluguer::className(), ['METD_PGMENT_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelInscricaoViagens()
    {
        return $this->hasMany(SgdnRelInscricaoViagen::className(), ['METD_PGMENT_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelMatriculas()
    {
        return $this->hasMany(SgdnRelMatricula::className(), ['METD_PGMENT_ID' => 'ID']);
    }
}
