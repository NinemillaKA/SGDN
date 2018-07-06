<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sgdn_pr_documento_tp".
 *
 * @property string $ID
 * @property string $CODIGO
 * @property string $DESIG
 * @property string $DESCR
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdnRelDocumentos[] $sgdnRelDocumentos
 */
class SgdnPrDocumentoTp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_pr_documento_tp';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'CODIGO', 'DESIG', 'DT_REGISTO', 'ESTADO'], 'required'],
            [['DT_REGISTO'], 'safe'],
            [['ID'], 'string', 'max' => 36],
            [['CODIGO'], 'string', 'max' => 5],
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
            'CODIGO' => 'Codigo',
            'DESIG' => 'Desig',
            'DESCR' => 'Descr',
            'DT_REGISTO' => 'Dt  Registo',
            'ESTADO' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelDocumentos()
    {
        return $this->hasMany(SgdnRelDocumentos::className(), ['PR_DOCUMENTO_TP_ID' => 'ID']);
    }
}
