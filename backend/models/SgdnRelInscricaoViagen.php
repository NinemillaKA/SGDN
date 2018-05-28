<?php

namespace backend\models;

use Yii;
use \Faker\Provider\Uuid;

/**
 * This is the model class for table "sgdn_rel_inscricao_viagen".
 *
 * @property string $ID
 * @property string $VIAGEM_ID
 * @property string $PESSOA_ID
 * @property string $INSTRUTOR_ID
 * @property string $DATA
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdmInstrutor $iNSTRUTOR
 * @property SgdnPessoa $pESSOA
 * @property SgdnViagen $vIAGEM
 */
class SgdnRelInscricaoViagen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_rel_inscricao_viagen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['VIAGEM_ID'], 'required'],
            [['DT_REGISTO'], 'safe'],
            [['ID', 'VIAGEM_ID', 'PESSOA_ID', 'INSTRUTOR_ID'], 'string', 'max' => 36],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
            [['INSTRUTOR_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdmInstrutor::className(), 'targetAttribute' => ['INSTRUTOR_ID' => 'ID']],
            // [['PESSOA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnPessoa::className(), 'targetAttribute' => ['PESSOA_ID' => 'ID']],
            [['VIAGEM_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnViagen::className(), 'targetAttribute' => ['VIAGEM_ID' => 'ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'VIAGEM_ID' => 'Viagem  ID',
            'PESSOA_ID' => 'Pessoa  ID',
            // 'INSTRUTOR_ID' => 'Instrutor  ID',
            'DATA' => 'Data',
            'DT_REGISTO' => 'Dt  Registo',
            'ESTADO' => 'Estado',
        ];
    }

    // /**
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getINSTRUTOR()
    // {
    //     return $this->hasOne(SgdmInstrutor::className(), ['ID' => 'INSTRUTOR_ID']);
    // }

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
    public function getVIAGEM()
    {
        return $this->hasOne(SgdnViagen::className(), ['ID' => 'VIAGEM_ID']);
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
