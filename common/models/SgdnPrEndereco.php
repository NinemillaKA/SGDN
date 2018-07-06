<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sgdn_pr_endereco".
 *
 * @property string $ID
 * @property string $ENTIDADE_ID
 * @property string $PAIS
 * @property string $ILHA
 * @property string $CONCELHO
 * @property string $FREGUESIA
 * @property string $ZONA
 * @property string $DESC
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdnEntidade $eNTIDADE
 * @property SgdnRelSpotEndereco[] $sgdnRelSpotEnderecos
 */
class SgdnPrEndereco extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_pr_endereco';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'ENTIDADE_ID'], 'required'],
            [['DT_REGISTO'], 'safe'],
            [['ID', 'ENTIDADE_ID'], 'string', 'max' => 36],
            [['PAIS', 'ILHA', 'CONCELHO', 'FREGUESIA', 'ZONA'], 'string', 'max' => 50],
            [['DESC'], 'string', 'max' => 300],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
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
            'PAIS' => 'Pais',
            'ILHA' => 'Ilha',
            'CONCELHO' => 'Concelho',
            'FREGUESIA' => 'Freguesia',
            'ZONA' => 'Zona',
            'DESC' => 'Desc',
            'DT_REGISTO' => 'Dt  Registo',
            'ESTADO' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getENTIDADE()
    {
        return $this->hasOne(SgdnEntidade::className(), ['ID' => 'ENTIDADE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelSpotEnderecos()
    {
        return $this->hasMany(SgdnRelSpotEndereco::className(), ['ENDERECO_ID' => 'ID']);
    }
}
