<?php

namespace backend\models;

use Yii;
use \Faker\Provider\Uuid;

/**
 * This is the model class for table "sgdn_spot".
 *
 * @property string $ID
 * @property string $GEOGRAFIA_ID
 * @property string $CODIGO
 * @property string $DESIG
 * @property string $DESCR
 * @property string $URL_IMAGEM
 * @property string $ENDERECO
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdnRelEntidadeSpot[] $sgdnRelEntidadeSpots
 * @property SgdnRelSpotEndereco[] $sgdnRelSpotEnderecos
 * @property GlbGeografia $gEOGRAFIA
 */
class SgdnSpot extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_spot';
    }

    /**
     * @inheritdoc
     */
    public $file;
    public function rules()
    {
        return [
            [['GEOGRAFIA_ID', 'CODIGO', 'DESIG'], 'required'],
            [['DT_REGISTO'], 'safe'],
            [['ID'], 'string', 'max' => 36],
            [['GEOGRAFIA_ID'], 'string', 'max' => 50],
            [['CODIGO'], 'string', 'max' => 5],
            [['DESIG','ENDERECO'], 'string', 'max' => 300],
            [['DESCR'], 'string', 'max' => 2000],
            [['URL_IMAGEM'], 'string', 'max' => 128],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'checkExtensionByMimeType'=>false, 'maxFiles' => 1],
            [['GEOGRAFIA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => GlbGeografia::className(), 'targetAttribute' => ['GEOGRAFIA_ID' => 'ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'GEOGRAFIA_ID' => 'Geografia  ID',
            'CODIGO' => 'Codigo',
            'DESIG' => 'Desig',
            'DESCR' => 'Descr',
            'URL_IMAGEM' => 'Url  Imagem',
            'ENDERECO' => 'Endereco',
            'DT_REGISTO' => 'Dt  Registo',
            'ESTADO' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelEntidadeSpots()
    {
        return $this->hasMany(SgdnRelEntidadeSpot::className(), ['SPOT_ID' => 'ID']);
    }

    // /**
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getSgdnRelSpotEnderecos()
    // {
    //     return $this->hasMany(SgdnRelSpotEndereco::className(), ['SPOT_ID' => 'ID']);
    // }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGEOGRAFIA()
    {
        return $this->hasOne(GlbGeografia::className(), ['ID' => 'GEOGRAFIA_ID']);
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
