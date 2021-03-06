<?php

namespace backend\models;

use Yii;
use \Faker\Provider\Uuid;
/**
 * This is the model class for table "sgdm_instrutor".
 *
 * @property string $ID
 * @property string $PESSOA_ID
 * @property string $CODIGO
 * @property string $OBS
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdnPessoa $pESSOA
 * @property SgdnRelInstrutorModalidade[] $sgdnRelInstrutorModalidades
 */
class SgdmInstrutor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdm_instrutor';
    }

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['PESSOA_ID', 'CODIGO'], 'required'],
            [['DT_REGISTO'], 'safe'],
            [['ID', 'PESSOA_ID'], 'string', 'max' => 36],
            [['CODIGO'], 'string', 'max' => 5],
            [['OBS'], 'string', 'max' => 2000],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
            [['PESSOA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnPessoa::className(), 'targetAttribute' => ['PESSOA_ID' => 'ID']],
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
            'CODIGO' => 'Codigo',
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
    public function getSgdnRelInstrutorModalidades()
    {
        return $this->hasMany(SgdnRelInstrutorModalidade::className(), ['INSTRUTOR_ID' => 'ID']);
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
