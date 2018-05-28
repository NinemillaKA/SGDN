<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sgdn_rel_perfil_menu".
 *
 * @property string $ID
 * @property string $PERFIL_ID
 * @property string $MENU_ID
 *
 * @property SgdnMenu $mENU
 * @property SgdnRelPerfil $pERFIL
 */
class SgdnRelPerfilMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_rel_perfil_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'PERFIL_ID', 'MENU_ID'], 'required'],
            [['ID', 'PERFIL_ID', 'MENU_ID'], 'string', 'max' => 36],
            [['ID'], 'unique'],
            [['MENU_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnMenu::className(), 'targetAttribute' => ['MENU_ID' => 'ID']],
            [['PERFIL_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnRelPerfil::className(), 'targetAttribute' => ['PERFIL_ID' => 'ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'PERFIL_ID' => 'Perfil  ID',
            'MENU_ID' => 'Menu  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMENU()
    {
        return $this->hasOne(SgdnMenu::className(), ['ID' => 'MENU_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPERFIL()
    {
        return $this->hasOne(SgdnRelPerfil::className(), ['ID' => 'PERFIL_ID']);
    }
}
