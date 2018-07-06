<?php

namespace backend\models;

use Yii;
use \Faker\Provider\Uuid;

/**
 * This is the model class for table "sgdn_rel_alojamento".
 *
 * @property string $ID
 * @property string $PESSOA_ID
 * @property string $RESIDENCIA_ID
 * @property string $METD_PGMENT_ID
 * @property string $OBS
 * @property string $DT_ENTRADA
 * @property string $DT_SAIDA
 * @property string $TOTAL
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdnPessoa $pESSOA
 * @property SgdnPrMetodoPagamento $mETDPGMENT
 * @property SgdnResidencia $rESIDENCIA
 */
class SgdnRelAlojamento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_rel_alojamento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'PESSOA_ID', 'RESIDENCIA_ID','METD_PGMENT_ID', 'DT_ENTRADA'], 'required'],
            [['DT_ENTRADA', 'DT_SAIDA', 'DT_REGISTO'], 'safe'],
            [['ID', 'PESSOA_ID', 'RESIDENCIA_ID', 'METD_PGMENT_ID'], 'string', 'max' => 36],
            [['OBS'], 'string', 'max' => 500],
            [['TOTAL'], 'string', 'max' => 10],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
            [['PESSOA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnPessoa::className(), 'targetAttribute' => ['PESSOA_ID' => 'ID']],
            [['METD_PGMENT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnPrMetodoPagamento::className(), 'targetAttribute' => ['METD_PGMENT_ID' => 'ID']],
            [['RESIDENCIA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnResidencia::className(), 'targetAttribute' => ['RESIDENCIA_ID' => 'ID']],
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
            'RESIDENCIA_ID' => 'Residencia  ID',
            'METD_PGMENT_ID' => 'Metd Pgment ID',
            'OBS' => 'Obs',
            'DT_ENTRADA' => 'Dt  Entrada',
            'DT_SAIDA' => 'Dt  Saida',
            'TOTAL' => 'Total',
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

    public function getMETDPGMENT()
    {
        return $this->hasOne(SgdnPrMetodoPagamento::className(), ['ID' => 'METD_PGMENT_ID']);
    }

   /**
    * @return \yii\db\ActiveQuery
    */
    public function getRESIDENCIA()
    {
        return $this->hasOne(SgdnResidencia::className(), ['ID' => 'RESIDENCIA_ID']);
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
