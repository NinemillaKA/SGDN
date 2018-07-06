<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sgdn_pr_modalidade".
 *
 * @property string $ID
 * @property string $CODIGO
 * @property string $DESIG
 * @property string $URL_IMAGEM
 * @property string $DESCR
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdnRelAula[] $sgdnRelAulas
 * @property SgdnRelInstrutorModalidade[] $sgdnRelInstrutorModalidades
 * @property SgdnRelMaterialModalidade[] $sgdnRelMaterialModalidades
 */
class SgdnPrModalidade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_pr_modalidade';
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
            [['DESIG'], 'string', 'max' => 300],
            [['URL_IMAGEM'], 'string', 'max' => 128],
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
            'URL_IMAGEM' => 'Url  Imagem',
            'DESCR' => 'Descr',
            'DT_REGISTO' => 'Dt  Registo',
            'ESTADO' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelAulas()
    {
        return $this->hasMany(SgdnRelAula::className(), ['MODALIDADE_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelInstrutorModalidades()
    {
        return $this->hasMany(SgdnRelInstrutorModalidade::className(), ['PR_MODALIDADE_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelMaterialModalidades()
    {
        return $this->hasMany(SgdnRelMaterialModalidade::className(), ['MODALIDADE_ID' => 'ID']);
    }
}
