<?php

namespace backend\models;

use Yii;
use \Faker\Provider\Uuid;

/**
 * This is the model class for table "sgdn_material".
 *
 * @property string $ID
 * @property string $MATERIAL_TP_ID
 * @property string $CODIGO
 * @property string $DESIG
 * @property string $URL_LOGO
 * @property string $DESCR
 * @property string $ESTADO_MATERIAL
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdnPrMaterialTp $mATERIALTP
 * @property SgdnRelMaterialModalidade[] $sgdnRelMaterialModalidades
 */
class SgdnMaterial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_material';
    }

    /**
     * @inheritdoc
     */

    public $file;
    public function rules()
    {
        return [
            [['MATERIAL_TP_ID','MATERIAL_MARCA_ID', 'ESTADO_MATERIAL', 'CODIGO', 'DESIG'], 'required'],
            [['DT_REGISTO'], 'safe'],
            [['ID', 'MATERIAL_TP_ID','MATERIAL_MARCA_ID', 'CODIGO'], 'string', 'max' => 36],
            [['DESIG'], 'string', 'max' => 350],
            [['URL_LOGO'], 'string', 'max' => 128],
            [['DESCR'], 'string', 'max' => 2000],
            [['ESTADO_MATERIAL','ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'checkExtensionByMimeType'=>false, 'maxFiles' => 1],
            [['MATERIAL_TP_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnPrMaterialTp::className(), 'targetAttribute' => ['MATERIAL_TP_ID' => 'ID']],
            [['MATERIAL_MARCA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnPrMaterialMarca::className(), 'targetAttribute' => ['MATERIAL_MARCA_ID' => 'ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'MATERIAL_TP_ID' => 'Material  Tp  ID',
            'MATERIAL_MARCA_ID' => 'Material Marca ID',
            'CODIGO' => 'Codigo',
            'DESIG' => 'Desig',
            'URL_LOGO' => 'Url  Logo',
            'DESCR' => 'Descr',
            'ESTADO_MATERIAL' => 'Estado Material', 
            'DT_REGISTO' => 'Dt  Registo',
            'ESTADO' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMATERIALTP()
    {
        return $this->hasOne(SgdnPrMaterialTp::className(), ['ID' => 'MATERIAL_TP_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
     public function getMATERIALMARCA()
     {
        return $this->hasOne(SgdnPrMaterialMarca::className(), ['ID' => 'MATERIAL_MARCA_ID']);
     }

/**
 * @return \yii\db\ActiveQuery
 */

    public function getSgdnRelMaterialModalidades()
    {
        return $this->hasMany(SgdnRelMaterialModalidade::className(), ['MATERIAL_ID' => 'ID']);
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
