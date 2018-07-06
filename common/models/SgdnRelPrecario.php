<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sgdn_rel_precario".
 *
 * @property string $ID
 * @property string $REL_AULA_ID
 * @property string $REL_MATERIAL_MODALIDADE_ID
 * @property string $CODIGO
 * @property double $PRECO
 * @property string $OBS
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdnRelAluguer[] $sgdnRelAluguers
 * @property SgdnRelAula $rELAULA
 * @property SgdnRelMaterialModalidade $rELMATERIALMODALIDADE
 */
class SgdnRelPrecario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_rel_precario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'CODIGO', 'PRECO', 'DT_REGISTO', 'ESTADO'], 'required'],
            [['PRECO'], 'number'],
            [['DT_REGISTO'], 'safe'],
            [['ID', 'REL_AULA_ID', 'REL_MATERIAL_MODALIDADE_ID'], 'string', 'max' => 36],
            [['CODIGO'], 'string', 'max' => 5],
            [['OBS'], 'string', 'max' => 2000],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
            [['REL_AULA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnRelAula::className(), 'targetAttribute' => ['REL_AULA_ID' => 'ID']],
            [['REL_MATERIAL_MODALIDADE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnRelMaterialModalidade::className(), 'targetAttribute' => ['REL_MATERIAL_MODALIDADE_ID' => 'ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'REL_AULA_ID' => 'Rel  Aula  ID',
            'REL_MATERIAL_MODALIDADE_ID' => 'Rel  Material  Modalidade  ID',
            'CODIGO' => 'Codigo',
            'PRECO' => 'Preco',
            'OBS' => 'Obs',
            'DT_REGISTO' => 'Dt  Registo',
            'ESTADO' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelAluguers()
    {
        return $this->hasMany(SgdnRelAluguer::className(), ['PRECARIO_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRELAULA()
    {
        return $this->hasOne(SgdnRelAula::className(), ['ID' => 'REL_AULA_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRELMATERIALMODALIDADE()
    {
        return $this->hasOne(SgdnRelMaterialModalidade::className(), ['ID' => 'REL_MATERIAL_MODALIDADE_ID']);
    }
}
