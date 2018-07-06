<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sgdn_rel_viagen_instrutor".
 *
 * @property string $ID
 * @property string $VIAGEM_ID
 * @property string $INSTRUTOR_ID
 * @property string $CODIGO
 * @property string $DATA
 * @property string $OBS
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdmInstrutor $iNSTRUTOR
 * @property SgdnViagen $vIAGEM
 */
class SgdnRelViagenInstrutor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_rel_viagen_instrutor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'VIAGEM_ID', 'INSTRUTOR_ID', 'CODIGO', 'DATA', 'DT_REGISTO', 'ESTADO'], 'required'],
            [['DATA', 'DT_REGISTO'], 'safe'],
            [['ID', 'VIAGEM_ID', 'INSTRUTOR_ID'], 'string', 'max' => 36],
            [['CODIGO'], 'string', 'max' => 5],
            [['OBS'], 'string', 'max' => 2000],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
            [['INSTRUTOR_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdmInstrutor::className(), 'targetAttribute' => ['INSTRUTOR_ID' => 'ID']],
            [['VIAGEM_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnViagen::className(), 'targetAttribute' => ['VIAGEM_ID' => 'ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'VIAGEM_ID' => 'Viagem  ID',
            'INSTRUTOR_ID' => 'Instrutor  ID',
            'CODIGO' => 'Codigo',
            'DATA' => 'Data',
            'OBS' => 'Obs',
            'DT_REGISTO' => 'Dt  Registo',
            'ESTADO' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getINSTRUTOR()
    {
        return $this->hasOne(SgdmInstrutor::className(), ['ID' => 'INSTRUTOR_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVIAGEM()
    {
        return $this->hasOne(SgdnViagen::className(), ['ID' => 'VIAGEM_ID']);
    }
}
