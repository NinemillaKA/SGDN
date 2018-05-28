<?php

namespace backend\models;

use Yii;
use \Faker\Provider\Uuid;

/**
 * This is the model class for table "sgdn_rel_aluguer".
 *
 * @property string $ID
 * @property string $PESSOA_ID
 * @property string $PRECARIO_ID
 * @property string $DT_ALUGUER
 * @property string $DT_DEVOLUCAO
 * @property double $VALOR
 * @property string $OBS
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
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
            [['PRECARIO_ID', 'DT_ALUGUER','DT_DEVOLUCAO', 'VALOR'], 'required'],
            [['PRECARIO_ID','DT_ALUGUER', 'DT_DEVOLUCAO', 'DT_REGISTO'], 'safe'],
            [['VALOR'], 'number'],
            [['ID', 'PESSOA_ID', 'PRECARIO_ID'], 'string', 'max' => 36],
            [['OBS'], 'string', 'max' => 2000],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
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

    public function beforeSave($insert)
    {
        if ($insert) {
          $this->PRECARIO_ID = $this->PRECARIO_ID;
          $this->ID = Uuid::uuid();
          $this->DT_REGISTO = date('Y-m-d h:m:s');
          $this->ESTADO = 'A';


            return true;
         }

        return parent::beforeSave($insert);
    }

}
