<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sgdn_pr_material_marca".
 *
 * @property string $ID
 * @property string $CODIGO
 * @property string $DESIG
 * @property string $OBS
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdnMaterial[] $sgdnMaterials
 */
class SgdnPrMaterialMarca extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_pr_material_marca';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'CODIGO', 'DESIG', 'DT_REGISTO', 'ESTADO'], 'required'],
            [['DT_REGISTO'], 'safe'],
            [['ID', 'CODIGO'], 'string', 'max' => 36],
            [['DESIG'], 'string', 'max' => 200],
            [['OBS'], 'string', 'max' => 2000],
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
            'OBS' => 'Obs',
            'DT_REGISTO' => 'Dt  Registo',
            'ESTADO' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnMaterials()
    {
        return $this->hasMany(SgdnMaterial::className(), ['MATERIAL_MARCA_ID' => 'ID']);
    }
}
