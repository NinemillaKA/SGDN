<?php

namespace backend\models;

use Yii;
use \Faker\Provider\Uuid;

/**
 * This is the model class for table "sgdn_rel_responsavel".
 *
 * @property string $ID
 * @property string $PESSOA_ID
 * @property string $REL_RESIDENCIA_ID
 * @property string $DT_INICIO
 * @property string $DT_FIM
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdnPessoa $pESSOA
 * @property SgdnResidencia $rELRESIDENCIA
 */
class SgdnRelResponsavel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_rel_responsavel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PESSOA_ID', 'REL_RESIDENCIA_ID', 'DT_INICIO'], 'required'],
            [['DT_INICIO', 'DT_FIM', 'DT_REGISTO'], 'safe'],
            [['ID', 'PESSOA_ID', 'REL_RESIDENCIA_ID'], 'string', 'max' => 36],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
            [['PESSOA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnPessoa::className(), 'targetAttribute' => ['PESSOA_ID' => 'ID']],
            [['REL_RESIDENCIA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnResidencia::className(), 'targetAttribute' => ['REL_RESIDENCIA_ID' => 'ID']],
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
            'REL_RESIDENCIA_ID' => 'Rel  Residencia  ID',
            'DT_INICIO' => 'Dt  Inicio',
            'DT_FIM' => 'Dt  Fim',
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
    public function getRELRESIDENCIA()
    {
        return $this->hasOne(SgdnResidencia::className(), ['ID' => 'REL_RESIDENCIA_ID']);
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

    public function afterFind(){ //inverter data

        parent::afterFind();
        $this->DT_INICIO = explode(' ',$this->DT_INICIO);
        $this->DT_INICIO = $this->DT_INICIO[0];
        $this->DT_FIM = explode(' ',$this->DT_FIM);
        $this->DT_FIM =$this->DT_FIM[0];
    }
}
