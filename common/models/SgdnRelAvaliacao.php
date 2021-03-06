<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sgdn_rel_avaliacao".
 *
 * @property string $ID
 * @property string $MATRICULA_ID
 * @property string $AVALIACAO_TP
 * @property string $OBS
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdnPrAvaliacaoTp $aVALIACAOTP
 * @property SgdnRelMatricula $mATRICULA
 */
class SgdnRelAvaliacao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_rel_avaliacao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'MATRICULA_ID', 'AVALIACAO_TP', 'DT_REGISTO', 'ESTADO'], 'required'],
            [['DT_REGISTO'], 'safe'],
            [['ID', 'MATRICULA_ID', 'AVALIACAO_TP'], 'string', 'max' => 36],
            [['OBS'], 'string', 'max' => 2000],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
            [['AVALIACAO_TP'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnPrAvaliacaoTp::className(), 'targetAttribute' => ['AVALIACAO_TP' => 'ID']],
            [['MATRICULA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnRelMatricula::className(), 'targetAttribute' => ['MATRICULA_ID' => 'ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'MATRICULA_ID' => 'Matricula  ID',
            'AVALIACAO_TP' => 'Avaliacao  Tp',
            'OBS' => 'Obs',
            'DT_REGISTO' => 'Dt  Registo',
            'ESTADO' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAVALIACAOTP()
    {
        return $this->hasOne(SgdnPrAvaliacaoTp::className(), ['ID' => 'AVALIACAO_TP']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMATRICULA()
    {
        return $this->hasOne(SgdnRelMatricula::className(), ['ID' => 'MATRICULA_ID']);
    }
}
