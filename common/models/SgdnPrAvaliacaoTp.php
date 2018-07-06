<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sgdn_pr_avaliacao_tp".
 *
 * @property string $ID
 * @property string $CODIGO
 * @property string $DESIG
 * @property string $OBS
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdnRelAvaliacao[] $sgdnRelAvaliacaos
 */
class SgdnPrAvaliacaoTp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_pr_avaliacao_tp';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'CODIGO', 'DESIG', 'DT_REGISTO', 'ESTADO'], 'required'],
            [['DT_REGISTO'], 'safe'],
            [['ID'], 'string', 'max' => 36],
            [['CODIGO'], 'string', 'max' => 5],
            [['DESIG'], 'string', 'max' => 250],
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
    public function getSgdnRelAvaliacaos()
    {
        return $this->hasMany(SgdnRelAvaliacao::className(), ['AVALIACAO_TP' => 'ID']);
    }
}
