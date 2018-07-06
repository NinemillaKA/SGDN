<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sgdn_rel_aluguer".
 *
 * @property string $ID
 * @property string $PESSOA_ID
 * @property string $PRECARIO_ID
 * @property string $METD_PGMENT_ID
 * @property string $DT_ALUGUER
 * @property string $DT_DEVOLUCAO
 * @property double $VALOR
 * @property string $OBS
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdnPrMetodoPagamento $mETDPGMENT
 * @property SgdnPessoa $pESSOA
 * @property SgdnRelPrecario $pRECARIO
 */
class SgdnRelAluguer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_rel_aluguer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'PESSOA_ID', 'PRECARIO_ID', 'METD_PGMENT_ID', 'DT_ALUGUER', 'DT_REGISTO', 'ESTADO'], 'required'],
            [['DT_ALUGUER', 'DT_DEVOLUCAO', 'DT_REGISTO'], 'safe'],
            [['VALOR'], 'number'],
            [['ID', 'PESSOA_ID', 'PRECARIO_ID', 'METD_PGMENT_ID'], 'string', 'max' => 36],
            [['OBS'], 'string', 'max' => 2000],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
            [['METD_PGMENT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnPrMetodoPagamento::className(), 'targetAttribute' => ['METD_PGMENT_ID' => 'ID']],
            [['PESSOA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnPessoa::className(), 'targetAttribute' => ['PESSOA_ID' => 'ID']],
            [['PRECARIO_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnRelPrecario::className(), 'targetAttribute' => ['PRECARIO_ID' => 'ID']],
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
            'PRECARIO_ID' => 'Precario  ID',
            'METD_PGMENT_ID' => 'Metd  Pgment  ID',
            'DT_ALUGUER' => 'Dt  Aluguer',
            'DT_DEVOLUCAO' => 'Dt  Devolucao',
            'VALOR' => 'Valor',
            'OBS' => 'Obs',
            'DT_REGISTO' => 'Dt  Registo',
            'ESTADO' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMETDPGMENT()
    {
        return $this->hasOne(SgdnPrMetodoPagamento::className(), ['ID' => 'METD_PGMENT_ID']);
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
    public function getPRECARIO()
    {
        return $this->hasOne(SgdnRelPrecario::className(), ['ID' => 'PRECARIO_ID']);
    }
}
