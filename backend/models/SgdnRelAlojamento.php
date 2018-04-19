<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sgdn_rel_alojamento".
 *
 * @property string $ID
 * @property string $PESSOA_ID
 * @property string $RESIDENCIA_ID
 * @property string $OBS
 * @property string $DT_ENTRADA
 * @property string $DT_SAIDA
 * @property string $TOTAL
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdnPessoa $pESSOA
 * @property SgdnResidencia $rESIDENCIA
 */
class SgdnRelAlojamento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_rel_alojamento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'PESSOA_ID', 'RESIDENCIA_ID', 'DT_ENTRADA', 'DT_REGISTO', 'ESTADO'], 'required'],
            [['DT_ENTRADA', 'DT_SAIDA', 'DT_REGISTO'], 'safe'],
            [['ID', 'PESSOA_ID', 'RESIDENCIA_ID'], 'string', 'max' => 36],
            [['OBS'], 'string', 'max' => 500],
            [['TOTAL'], 'string', 'max' => 10],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
            [['PESSOA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnPessoa::className(), 'targetAttribute' => ['PESSOA_ID' => 'ID']],
            [['RESIDENCIA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnResidencia::className(), 'targetAttribute' => ['RESIDENCIA_ID' => 'ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'PESSOA_ID' => 'Pessoa  ID',
            'RESIDENCIA_ID' => 'Residencia  ID',
            'OBS' => 'Obs',
            'DT_ENTRADA' => 'Dt  Entrada',
            'DT_SAIDA' => 'Dt  Saida',
            'TOTAL' => 'Total',
            'DT_REGISTO' => 'Dt  Registo',
            'ESTADO' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPESSOA()
    {
        return $this->hasOne(SgdnPessoa::className(), ['ID' => 'PESSOA_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRESIDENCIA()
    {
        return $this->hasOne(SgdnResidencia::className(), ['ID' => 'RESIDENCIA_ID']);
    }
}
