<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sgdn_menu".
 *
 * @property string $ID
 * @property string $DESIG
 * @property string $DESCR
 * @property string $CONTROLLER
 * @property string $ESTADO
 * @property string $DT_REGISTO
 * @property string $DT_UPDATE
 * @property string $ACTION
 * @property int $FLAG_DISPLAY
 * @property string $MENU_ID
 *
 * @property SgdnRelPerfilMenu[] $sgdnRelPerfilMenus
 */
class SgdnMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'DESIG', 'ESTADO', 'DT_REGISTO', 'DT_UPDATE'], 'required'],
            [['DT_REGISTO', 'DT_UPDATE'], 'safe'],
            [['FLAG_DISPLAY'], 'integer'],
            [['ID', 'MENU_ID'], 'string', 'max' => 36],
            [['DESIG', 'CONTROLLER'], 'string', 'max' => 250],
            [['DESCR'], 'string', 'max' => 2000],
            [['ESTADO'], 'string', 'max' => 1],
            [['ACTION'], 'string', 'max' => 100],
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
            'CONTROLLER' => 'Controller',
            'ESTADO' => 'Estado',
            'DT_REGISTO' => 'Dt  Registo',
            'DT_UPDATE' => 'Dt  Update',
            'ACTION' => 'Action',
            'FLAG_DISPLAY' => 'Flag  Display',
            'MENU_ID' => 'Menu  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelPerfilMenus()
    {
        return $this->hasMany(SgdnRelPerfilMenu::className(), ['MENU_ID' => 'ID']);
    }
}
