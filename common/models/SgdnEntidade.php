<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sgdn_entidade".
 *
 * @property string $ID
 * @property string $GLB_GEOGRAFIA_ID
 * @property string $CODIGO
 * @property string $DESIG
 * @property string $URL_LOGO
 * @property string $OBS
 * @property string $ENDERECO
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property GlbGeografia $gLBGEOGRAFIA
 * @property SgdnPrEndereco[] $sgdnPrEnderecos
 * @property SgdnRelContactos[] $sgdnRelContactos
 * @property SgdnRelDocumentos[] $sgdnRelDocumentos
 * @property SgdnRelEntidadeSpot[] $sgdnRelEntidadeSpots
 */
class SgdnEntidade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_entidade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'GLB_GEOGRAFIA_ID', 'CODIGO', 'DESIG', 'DT_REGISTO', 'ESTADO'], 'required'],
            [['DT_REGISTO'], 'safe'],
            [['ID'], 'string', 'max' => 36],
            [['GLB_GEOGRAFIA_ID'], 'string', 'max' => 50],
            [['CODIGO'], 'string', 'max' => 5],
            [['DESIG', 'ENDERECO'], 'string', 'max' => 300],
            [['URL_LOGO'], 'string', 'max' => 128],
            [['OBS'], 'string', 'max' => 2000],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
            [['GLB_GEOGRAFIA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => GlbGeografia::className(), 'targetAttribute' => ['GLB_GEOGRAFIA_ID' => 'ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'GLB_GEOGRAFIA_ID' => 'Glb  Geografia  ID',
            'CODIGO' => 'Codigo',
            'DESIG' => 'Desig',
            'URL_LOGO' => 'Url  Logo',
            'OBS' => 'Obs',
            'ENDERECO' => 'Endereco',
            'DT_REGISTO' => 'Dt  Registo',
            'ESTADO' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGLBGEOGRAFIA()
    {
        return $this->hasOne(GlbGeografia::className(), ['ID' => 'GLB_GEOGRAFIA_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnPrEnderecos()
    {
        return $this->hasMany(SgdnPrEndereco::className(), ['ENTIDADE_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelContactos()
    {
        return $this->hasMany(SgdnRelContactos::className(), ['ENTIDADE_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelDocumentos()
    {
        return $this->hasMany(SgdnRelDocumentos::className(), ['ENTIDADE_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelEntidadeSpots()
    {
        return $this->hasMany(SgdnRelEntidadeSpot::className(), ['ENTIDADE_ID' => 'ID']);
    }
}
