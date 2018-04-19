<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sgdn_rel_pessoa_endereco".
 *
 * @property string $ID
 * @property string $PESSOA_ID
 * @property string $ENDERECO_ID
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdnPrEndereco $eNDERECO
 * @property SgdnPessoa $pESSOA
 */
class SgdnRelPessoaEndereco extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_rel_pessoa_endereco';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'PESSOA_ID', 'ENDERECO_ID'], 'required'],
            [['DT_REGISTO'], 'safe'],
            [['ID', 'PESSOA_ID', 'ENDERECO_ID'], 'string', 'max' => 36],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
            [['ENDERECO_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnPrEndereco::className(), 'targetAttribute' => ['ENDERECO_ID' => 'ID']],
            [['PESSOA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnPessoa::className(), 'targetAttribute' => ['PESSOA_ID' => 'ID']],
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
            'ENDERECO_ID' => 'Endereco  ID',
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
    public function getPESSOA()
    {
        return $this->hasOne(SgdnPessoa::className(), ['ID' => 'PESSOA_ID']);
    }
}
