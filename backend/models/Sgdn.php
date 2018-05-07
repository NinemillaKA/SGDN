<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sgdn_rel_aula".
 *
 * @property string $ID
 * @property string $SPOT_ID
 * @property string $MODALIDADE_ID
 * @property string $INST_MODALIDADE_ID
 * @property string $CODIGO
 * @property string $DESIG
 * @property string $DT_INICIO
 * @property string $DT_FIM
 * @property string $HORA_INICIO
 * @property string $HORA_FIM
 * @property double $PRECO
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdnPrModalidade $mODALIDADE
 * @property SgdnRelEntidadeSpot $sPOT
 * @property SgdnRelInstrutorModalidade $iNSTMODALIDADE
 * @property SgdnRelMatricula[] $sgdnRelMatriculas
 * @property SgdnRelPrecario[] $sgdnRelPrecarios
 * @property SgdnRelRequisicao[] $sgdnRelRequisicaos
 */
class Sgdn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_rel_aula';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'SPOT_ID', 'MODALIDADE_ID', 'INST_MODALIDADE_ID', 'CODIGO', 'HORA_INICIO', 'HORA_FIM', 'DT_REGISTO'], 'required'],
            [['DT_INICIO', 'DT_FIM', 'DT_REGISTO'], 'safe'],
            [['PRECO'], 'number'],
            [['ID', 'SPOT_ID', 'MODALIDADE_ID', 'INST_MODALIDADE_ID', 'CODIGO'], 'string', 'max' => 36],
            [['DESIG'], 'string', 'max' => 300],
            [['HORA_INICIO', 'HORA_FIM'], 'string', 'max' => 4],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
            [['MODALIDADE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnPrModalidade::className(), 'targetAttribute' => ['MODALIDADE_ID' => 'ID']],
            [['SPOT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnRelEntidadeSpot::className(), 'targetAttribute' => ['SPOT_ID' => 'ID']],
            [['INST_MODALIDADE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnRelInstrutorModalidade::className(), 'targetAttribute' => ['INST_MODALIDADE_ID' => 'ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'SPOT_ID' => 'Spot  ID',
            'MODALIDADE_ID' => 'Modalidade  ID',
            'INST_MODALIDADE_ID' => 'Inst  Modalidade  ID',
            'CODIGO' => 'Codigo',
            'DESIG' => 'Desig',
            'DT_INICIO' => 'Dt  Inicio',
            'DT_FIM' => 'Dt  Fim',
            'HORA_INICIO' => 'Hora  Inicio',
            'HORA_FIM' => 'Hora  Fim',
            'PRECO' => 'Preco',
            'DT_REGISTO' => 'Dt  Registo',
            'ESTADO' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMODALIDADE()
    {
        return $this->hasOne(SgdnPrModalidade::className(), ['ID' => 'MODALIDADE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSPOT()
    {
        return $this->hasOne(SgdnRelEntidadeSpot::className(), ['ID' => 'SPOT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getINSTMODALIDADE()
    {
        return $this->hasOne(SgdnRelInstrutorModalidade::className(), ['ID' => 'INST_MODALIDADE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelMatriculas()
    {
        return $this->hasMany(SgdnRelMatricula::className(), ['AULA_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelPrecarios()
    {
        return $this->hasMany(SgdnRelPrecario::className(), ['REL_AULA_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelRequisicaos()
    {
        return $this->hasMany(SgdnRelRequisicao::className(), ['AULA_ID' => 'ID']);
    }
}
