<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sgdn_rel_user_pessoa".
 *
 * @property string $ID
 * @property int $USER_ID
 * @property string $PESSOA_ID
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdnPessoa $pESSOA
 * @property User $uSER
 */
class SgdnRelUserPessoa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_rel_user_pessoa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'USER_ID', 'PESSOA_ID'], 'required'],
            [['USER_ID'], 'integer'],
            [['DT_REGISTO'], 'safe'],
            [['ID', 'PESSOA_ID'], 'string', 'max' => 36],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
            [['PESSOA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnPessoa::className(), 'targetAttribute' => ['PESSOA_ID' => 'ID']],
            [['USER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['USER_ID' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'USER_ID' => 'User  ID',
            'PESSOA_ID' => 'Pessoa  ID',
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
    public function getUSER()
    {
        return $this->hasOne(User::className(), ['id' => 'USER_ID']);
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
