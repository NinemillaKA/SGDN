<?php

namespace backend\models;

use Yii;
use \Faker\Provider\Uuid;

/**
 * This is the model class for table "sgdn_rel_material_modalidade".
 *
 * @property string $ID
 * @property string $MATERIAL_ID
 * @property string $MODALIDADE_ID
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdnMaterial $mATERIAL
 * @property SgdnPrModalidade $mODALIDADE
 * @property SgdnRelPrecario[] $sgdnRelPrecarios
 * @property SgdnRelRequisicao[] $sgdnRelRequisicaos
 */
class SgdnRelMaterialModalidade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_rel_material_modalidade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MATERIAL_ID', 'MODALIDADE_ID'], 'required'],
            [['DT_REGISTO'], 'safe'],
            [['ID', 'MATERIAL_ID', 'MODALIDADE_ID'], 'string', 'max' => 36],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
            [['MATERIAL_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnMaterial::className(), 'targetAttribute' => ['MATERIAL_ID' => 'ID']],
            [['MODALIDADE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnPrModalidade::className(), 'targetAttribute' => ['MODALIDADE_ID' => 'ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'MATERIAL_ID' => 'Material  ID',
            'MODALIDADE_ID' => 'Modalidade  ID',
            'DT_REGISTO' => 'Dt  Registo',
            'ESTADO' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMATERIAL()
    {
        return $this->hasOne(SgdnMaterial::className(), ['ID' => 'MATERIAL_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMODALIDADE()
    {
        return $this->hasOne(SgdnPrModalidade::className(), ['ID' => 'MODALIDADE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelPrecarios()
    {
        return $this->hasMany(SgdnRelPrecario::className(), ['REL_MATERIAL_MODALIDADE_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelRequisicaos()
    {
        return $this->hasMany(SgdnRelRequisicao::className(), ['MODALIDADE_ID' => 'ID']);
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
