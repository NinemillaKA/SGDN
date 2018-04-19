<?php

namespace backend\models;

use Yii;
use \Faker\Provider\Uuid;

/**
 * This is the model class for table "sgdn_pr_estado_civil".
 *
 * @property string $ID
 * @property string $CODIGO
 * @property string $DESIG
 * @property string $DESCR
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdnPessoa[] $sgdnPessoas
 */
class SgdnPrEstadoCivil extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_pr_estado_civil';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CODIGO', 'DESIG'], 'required'],
            [['DT_REGISTO'], 'safe'],
            [['ID'], 'string', 'max' => 36],
            [['CODIGO'], 'string', 'max' => 5],
            [['DESIG'], 'string', 'max' => 250],
            [['DESCR'], 'string', 'max' => 2000],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'CODIGO' => 'CODIGO',
            'DESIG' => 'DESIGNAÇÃO',
            'DESCR' => 'DESCRIÇÃO',
            'DT_REGISTO' => 'DATA REGISTO',
            'ESTADO' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnPessoas()
    {
        return $this->hasMany(SgdnPessoa::className(), ['PR_ESTADO_CIVIL_ID' => 'ID']);
    }

    function beforeSave($insert){

      if ($insert) {
        $this->ID = Uuid::uuid();
        $this->DT_REGISTO = date('Y-m-d h:i:s');
        $this->ESTADO = 'A';

          return true;
       }

      return parent::beforeSave($insert);
    }
}
