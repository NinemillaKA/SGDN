<?php

namespace backend\models;

use Yii;
use \Faker\Provider\Uuid;

/**
 * This is the model class for table "sgdn_pr_material_tp".
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
class SgdnPrMaterialTp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_pr_material_tp';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CODIGO', 'DESIG'], 'required'],
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
        return $this->hasMany(SgdnMaterial::className(), ['MATERIAL_TP_ID' => 'ID']);
    }

    function beforeSave($insert){

      if ($insert) {
        $this->ID = Uuid::uuid();
        $this->DT_REGISTO = date('Y-m-d h:i:s');
        $this->ESTADO = 'A';

          return true;
       }

      return parent::beforeSave($insert);
    }


}
