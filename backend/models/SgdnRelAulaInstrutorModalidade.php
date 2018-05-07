<?php

namespace backend\models;

use Yii;
use \Faker\Provider\Uuid;
/**
 * This is the model class for table "sgdn_rel_aula_instrutor_modalidade".
 *
 * @property string $ID
 * @property string $AULA_ID
 * @property string $INSTRUTOR_MODALIDADE_ID
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdnRelAula $aULA
 * @property SgdnRelInstrutorModalidade $iNSTRUTORMODALIDADE
 */
class SgdnRelAulaInstrutorModalidade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_rel_aula_instrutor_modalidade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['INSTRUTOR_MODALIDADE_ID'], 'required'],
            [['DT_REGISTO'], 'safe'],
            [['ID', 'AULA_ID', 'INSTRUTOR_MODALIDADE_ID'], 'string', 'max' => 36],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
            [['AULA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnRelAula::className(), 'targetAttribute' => ['AULA_ID' => 'ID']],
            [['INSTRUTOR_MODALIDADE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnRelInstrutorModalidade::className(), 'targetAttribute' => ['INSTRUTOR_MODALIDADE_ID' => 'ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'AULA_ID' => 'Aula  ID',
            'INSTRUTOR_MODALIDADE_ID' => 'Instrutor  Modalidade  ID',
            'DT_REGISTO' => 'Dt  Registo',
            'ESTADO' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAULA()
    {
        return $this->hasOne(SgdnRelAula::className(), ['ID' => 'AULA_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getINSTRUTORMODALIDADE()
    {
        return $this->hasOne(SgdnRelInstrutorModalidade::className(), ['ID' => 'INSTRUTOR_MODALIDADE_ID']);
    }

    public function beforeSave($insert)
    {
        if ($insert) {
          $this->ID = Uuid::uuid();
          $this->DT_REGISTO = date('Y-m-d h:m:s');
          $this->ESTADO = 'A';

            return true;
         }

        return parent::beforeSave($insert);
    }
}
