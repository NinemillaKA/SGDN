<?php

namespace backend\models;

use Yii;
use \Faker\Provider\Uuid;

/**
 * This is the model class for table "sgdn_rel_contactos".
 *
 * @property string $ID
 * @property string $PR_CONTACTO_TP_ID
 * @property string $PESSOA_ID
 * @property string $ENTIDADE_ID
 * @property string $REL_RESIDENCIA_ID
 * @property string $CONTACTO
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdnPessoa $pESSOA
 * @property SgdnPrContactoTp $pRCONTACTOTP
 * @property SgdnEntidade $eNTIDADE
 * @property SgdnResidencia $rELRESIDENCIA
 */
class SgdnRelContactos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_rel_contactos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PR_CONTACTO_TP_ID', 'CONTACTO'], 'required'],
            [['DT_REGISTO'], 'safe'],
            [['ID', 'PR_CONTACTO_TP_ID', 'PESSOA_ID', 'ENTIDADE_ID', 'REL_RESIDENCIA_ID'], 'string', 'max' => 36],
            [['CONTACTO'], 'string', 'max' => 128],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
            [['PESSOA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnPessoa::className(), 'targetAttribute' => ['PESSOA_ID' => 'ID']],
            [['PR_CONTACTO_TP_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnPrContactoTp::className(), 'targetAttribute' => ['PR_CONTACTO_TP_ID' => 'ID']],
            [['ENTIDADE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnEntidade::className(), 'targetAttribute' => ['ENTIDADE_ID' => 'ID']],
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
            'PR_CONTACTO_TP_ID' => 'Pr  Contacto  Tp  ID',
            'PESSOA_ID' => 'Pessoa  ID',
            'ENTIDADE_ID' => 'Entidade  ID',
            'REL_RESIDENCIA_ID' => 'Rel  Residencia  ID',
            'CONTACTO' => 'Contacto',
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
    public function getPRCONTACTOTP()
    {
        return $this->hasOne(SgdnPrContactoTp::className(), ['ID' => 'PR_CONTACTO_TP_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getENTIDADE()
    {
        return $this->hasOne(SgdnEntidade::className(), ['ID' => 'ENTIDADE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRELRESIDENCIA()
    {
        return $this->hasOne(SgdnResidencia::className(), ['ID' => 'REL_RESIDENCIA_ID']);
    }

    /**
     * vendor/yiisoft/yii2/base/Model.php
     */
    public function beforeValidate()
    {
        if (parent::beforeValidate()) {

          $this->ID = Uuid::uuid();
          $this->DT_REGISTO = date('Y-m-d h:m:s');
          $this->ESTADO = 'A';

          return true;
        }
        return false;
      }
}
