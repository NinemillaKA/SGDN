<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sgdn_rel_spot_endereco".
 *
 * @property string $ID
 * @property string $ENDERECO_ID
 * @property string $SPOT_ID
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdnPrEndereco $eNDERECO
 * @property SgdnSpot $sPOT
 */
class SgdnRelSpotEndereco extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_rel_spot_endereco';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'ENDERECO_ID', 'SPOT_ID'], 'required'],
            [['DT_REGISTO'], 'safe'],
            [['ID', 'ENDERECO_ID', 'SPOT_ID'], 'string', 'max' => 36],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
            [['ENDERECO_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnPrEndereco::className(), 'targetAttribute' => ['ENDERECO_ID' => 'ID']],
            [['SPOT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnSpot::className(), 'targetAttribute' => ['SPOT_ID' => 'ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'ENDERECO_ID' => 'Endereco  ID',
            'SPOT_ID' => 'Spot  ID',
            'DT_REGISTO' => 'Dt  Registo',
            'ESTADO' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getENDERECO()
    {
        return $this->hasOne(SgdnPrEndereco::className(), ['ID' => 'ENDERECO_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSPOT()
    {
        return $this->hasOne(SgdnSpot::className(), ['ID' => 'SPOT_ID']);
    }
}
