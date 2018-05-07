<?php

namespace backend\models;

use Yii;
use \Faker\Provider\Uuid;

/**
 * This is the model class for table "sgdn_rel_matricula".
 *
 * @property string $ID
 * @property string $ALUNO_ID
 * @property string $AULA_ID
 * @property string $CODIGO
 * @property string $DATA
 * @property string $OBS
 * @property string $DT_REGISTO
 * @property string $ESTADO
 * @property double $PRECO
 *
 * @property SgdnRelAvaliacao[] $sgdnRelAvaliacaos
 * @property SgdnRelDocumentos[] $sgdnRelDocumentos
 * @property SgdnPessoa $aLUNO
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
            [['ALUNO_ID', 'AULA_ID', 'CODIGO',], 'required'],
            [['DATA', 'DT_REGISTO'], 'safe'],
            [['PRECO'], 'number'],
            [['ID', 'ALUNO_ID', 'AULA_ID'], 'string', 'max' => 36],
            [['CODIGO'], 'string', 'max' => 5],
            [['OBS'], 'string', 'max' => 2000],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
            [['ALUNO_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnPessoa::className(), 'targetAttribute' => ['ALUNO_ID' => 'ID']],
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
            'CODIGO' => 'Codigo',
            'DATA' => 'Data',
            'OBS' => 'Obs',
            'DT_REGISTO' => 'Dt  Registo',
            'ESTADO' => 'Estado',
            'PRECO' => 'Preco',
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
    public function getAULA()
    {
        return $this->hasOne(SgdnRelAula::className(), ['ID' => 'AULA_ID']);
    }

    public function beforeSave($insert)
    {
        if ($insert) {
          $this->ID = Uuid::uuid();
          $this->DATA = date('Y-m-d h:m:s');
          $this->DT_REGISTO = date('Y-m-d h:m:s');
          $this->ESTADO = 'A';

            return true;
         }

        return parent::beforeSave($insert);
    }
}
