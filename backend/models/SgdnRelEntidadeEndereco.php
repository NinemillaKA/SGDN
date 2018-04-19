<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sgdn_rel_entidade_endereco".
 *
 * @property string $ID
 * @property string $ENTIDADE_ID
 * @property string $ENDERECO_ID
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdnPrEndereco $eNDERECO
 * @property SgdnEntidade $eNTIDADE
 */
class SgdnRelEntidadeEndereco extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_rel_entidade_endereco';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'ENTIDADE_ID', 'ENDERECO_ID'], 'required'],
            [['DT_REGISTO'], 'safe'],
            [['ID', 'ENTIDADE_ID', 'ENDERECO_ID'], 'string', 'max' => 36],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
            [['ENDERECO_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnPrEndereco::className(), 'targetAttribute' => ['ENDERECO_ID' => 'ID']],
            [['ENTIDADE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnEntidade::className(), 'targetAttribute' => ['ENTIDADE_ID' => 'ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'ENTIDADE_ID' => 'Entidade  ID',
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
    public function getENTIDADE()
    {
        return $this->hasOne(SgdnEntidade::className(), ['ID' => 'ENTIDADE_ID']);
    }
}
