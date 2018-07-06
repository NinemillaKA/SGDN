<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sgdn_spot".
 *
 * @property string $ID
 * @property string $CODIGO
 * @property string $URL_IMAGEM
 * @property string $DESIG
 * @property string $DESCR
 * @property string $GEOGRAFIA_ID
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
    public function rules()
    {
        return [
            [['ID', 'CODIGO', 'DESIG', 'GEOGRAFIA_ID', 'DT_REGISTO', 'ESTADO'], 'required'],
            [['DT_REGISTO'], 'safe'],
            [['ID'], 'string', 'max' => 36],
            [['CODIGO'], 'string', 'max' => 5],
            [['URL_IMAGEM'], 'string', 'max' => 128],
            [['DESIG', 'ENDERECO'], 'string', 'max' => 300],
            [['DESCR'], 'string', 'max' => 2000],
            [['GEOGRAFIA_ID'], 'string', 'max' => 50],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
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
            'CODIGO' => 'Codigo',
            'URL_IMAGEM' => 'Url  Imagem',
            'DESIG' => 'Desig',
            'DESCR' => 'Descr',
            'GEOGRAFIA_ID' => 'Geografia  ID',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelSpotEnderecos()
    {
        return $this->hasMany(SgdnRelSpotEndereco::className(), ['SPOT_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGEOGRAFIA()
    {
        return $this->hasOne(GlbGeografia::className(), ['ID' => 'GEOGRAFIA_ID']);
    }
}
