<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sgdn_rel_perfil".
 *
 * @property string $ID
 * @property string $DESIG
 * @property string $DESCR
 * @property string $ESTADO
 * @property string $DT_REGISTO
 * @property string $DT_UPDATE
 */
class SgdnRelPerfil extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_rel_perfil';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'DESIG', 'ESTADO', 'DT_REGISTO', 'DT_UPDATE'], 'required'],
            [['DT_REGISTO', 'DT_UPDATE'], 'safe'],
            [['ID'], 'string', 'max' => 36],
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
            'DESIG' => 'Desig',
            'DESCR' => 'Descr',
            'ESTADO' => 'Estado',
            'DT_REGISTO' => 'Dt  Registo',
            'DT_UPDATE' => 'Dt  Update',
        ];
    }
}
