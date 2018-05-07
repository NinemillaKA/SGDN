<?php

namespace backend\models;

use Yii;
use \Faker\Provider\Uuid;
/**
 * This is the model class for table "sgdn_rel_entidade_spot".
 *
 * @property string $ID
 * @property string $ENTIDADE_ID
 * @property string $SPOT_ID
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdnRelAula[] $sgdnRelAulas
 * @property SgdnEntidade $eNTIDADE
 * @property SgdnSpot $sPOT
 */
class SgdnRelEntidadeSpot extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_rel_entidade_spot';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ENTIDADE_ID', 'SPOT_ID'], 'required'],
            [['DT_REGISTO'], 'safe'],
            [['ID', 'ENTIDADE_ID', 'SPOT_ID'], 'string', 'max' => 36],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
            [['ENTIDADE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnEntidade::className(), 'targetAttribute' => ['ENTIDADE_ID' => 'ID']],
            [['SPOT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnSpot::className(), 'targetAttribute' => ['SPOT_ID' => 'ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'ENTIDADE_ID' => 'Entidade  ID',
            'SPOT_ID' => 'Spot  ID',
            'DT_REGISTO' => 'Dt  Registo',
            'ESTADO' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelAulas()
    {
        return $this->hasMany(SgdnRelAula::className(), ['SPOT_ID' => 'ID']);
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
    public function getSPOT()
    {
        return $this->hasOne(SgdnSpot::className(), ['ID' => 'SPOT_ID']);
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
