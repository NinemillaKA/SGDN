<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sgdn_rel_matricula".
 *
 * @property string $ID
 * @property string $ALUNO_ID
 * @property string $AULA_ID
 * @property string $METD_PGMENT_ID
 * @property string $CODIGO
 * @property string $DATA
 * @property string $OBS
 * @property double $PRECO
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdnRelAvaliacao[] $sgdnRelAvaliacaos
 * @property SgdnRelDocumentos[] $sgdnRelDocumentos
 * @property SgdnPessoa $aLUNO
 * @property SgdnPrMetodoPagamento $mETDPGMENT
 * @property SgdnRelAula $aULA
 */
class SgdnRelMatricula extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_rel_matricula';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'ALUNO_ID', 'AULA_ID', 'METD_PGMENT_ID', 'CODIGO', 'DATA', 'DT_REGISTO', 'ESTADO'], 'required'],
            [['DATA', 'DT_REGISTO'], 'safe'],
            [['PRECO'], 'number'],
            [['ID', 'ALUNO_ID', 'AULA_ID'], 'string', 'max' => 36],
            [['METD_PGMENT_ID'], 'string', 'max' => 45],
            [['CODIGO'], 'string', 'max' => 5],
            [['OBS'], 'string', 'max' => 2000],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
            [['ALUNO_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnPessoa::className(), 'targetAttribute' => ['ALUNO_ID' => 'ID']],
            [['METD_PGMENT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnPrMetodoPagamento::className(), 'targetAttribute' => ['METD_PGMENT_ID' => 'ID']],
            [['AULA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnRelAula::className(), 'targetAttribute' => ['AULA_ID' => 'ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'ALUNO_ID' => 'Aluno  ID',
            'AULA_ID' => 'Aula  ID',
            'METD_PGMENT_ID' => 'Metd  Pgment  ID',
            'CODIGO' => 'Codigo',
            'DATA' => 'Data',
            'OBS' => 'Obs',
            'PRECO' => 'Preco',
            'DT_REGISTO' => 'Dt  Registo',
            'ESTADO' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelAvaliacaos()
    {
        return $this->hasMany(SgdnRelAvaliacao::className(), ['MATRICULA_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelDocumentos()
    {
        return $this->hasMany(SgdnRelDocumentos::className(), ['REL_MATRICULA_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getALUNO()
    {
        return $this->hasOne(SgdnPessoa::className(), ['ID' => 'ALUNO_ID']);
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
    public function getAULA()
    {
        return $this->hasOne(SgdnRelAula::className(), ['ID' => 'AULA_ID']);
    }
}
