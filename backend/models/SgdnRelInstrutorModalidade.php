<?php

namespace backend\models;

use Yii;
use Faker\Provider\Uuid;

/**
 * This is the model class for table "sgdn_rel_instrutor_modalidade".
 *
 * @property string $ID
 * @property string $PR_MODALIDADE_ID
 * @property string $INSTRUTOR_ID
 * @property string $DATA
 * @property string $OBS
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdnRelAula[] $sgdnRelAulas
 * @property SgdnRelDocumentos[] $sgdnRelDocumentos
 * @property SgdnPrModalidade $pRMODALIDADE
 * @property SgdmInstrutor $iNSTRUTOR
 */
class SgdnRelInstrutorModalidade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_rel_instrutor_modalidade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PR_MODALIDADE_ID', 'INSTRUTOR_ID', 'CODIGO',], 'required'],
            [['DATA', 'DT_REGISTO'], 'safe'],
            [['ID', 'PR_MODALIDADE_ID', 'INSTRUTOR_ID'], 'string', 'max' => 36],
            [['CODIGO'], 'string', 'max' => 5],
            [['OBS'], 'string', 'max' => 2000],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
            [['PR_MODALIDADE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnPrModalidade::className(), 'targetAttribute' => ['PR_MODALIDADE_ID' => 'ID']],
            [['INSTRUTOR_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdmInstrutor::className(), 'targetAttribute' => ['INSTRUTOR_ID' => 'ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'PR_MODALIDADE_ID' => 'Pr  Modalidade  ID',
            'INSTRUTOR_ID' => 'Instrutor  ID',
            'CODIGO' => 'Codigo',
            'DATA' => 'Data de Contrato',
            'OBS' => 'Obs',
            'DT_REGISTO' => 'Dt  Registo',
            'ESTADO' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelAulas()
    {
        return $this->hasMany(SgdnRelAula::className(), ['INST_MODALIDADE_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelDocumentos()
    {
        return $this->hasMany(SgdnRelDocumentos::className(), ['REL_INSTRUTOR_MODALIDADE_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPRMODALIDADE()
    {
        return $this->hasOne(SgdnPrModalidade::className(), ['ID' => 'PR_MODALIDADE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getINSTRUTOR()
    {
        return $this->hasOne(SgdmInstrutor::className(), ['ID' => 'INSTRUTOR_ID']);
    }

    public function beforeSave($insert)
    {
        if ($insert) {

            $this->ID = Uuid::uuid();
            $this->DT_REGISTO = date('Y-m-d h:m:s');
            $this->DATA = date('Y-m-d h:m:s');
            $this->ESTADO = 'A';

        return parent::beforeSave($insert);
      }

    }

}
