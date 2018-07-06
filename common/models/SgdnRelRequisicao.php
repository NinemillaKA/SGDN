<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sgdn_rel_requisicao".
 *
 * @property string $ID
 * @property string $AULA_ID
 * @property string $MODALIDADE_ID
 * @property int $QUANTIDADE
 * @property string $DATA
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdnRelAula $aULA
 * @property SgdnRelMaterialModalidade $mODALIDADE
 */
class SgdnRelRequisicao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_rel_requisicao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'AULA_ID', 'MODALIDADE_ID'], 'required'],
            [['QUANTIDADE'], 'integer'],
            [['DATA', 'DT_REGISTO'], 'safe'],
            [['ID', 'AULA_ID', 'MODALIDADE_ID'], 'string', 'max' => 36],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
            [['AULA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnRelAula::className(), 'targetAttribute' => ['AULA_ID' => 'ID']],
            [['MODALIDADE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnRelMaterialModalidade::className(), 'targetAttribute' => ['MODALIDADE_ID' => 'ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'AULA_ID' => 'Aula  ID',
            'MODALIDADE_ID' => 'Modalidade  ID',
            'QUANTIDADE' => 'Quantidade',
            'DATA' => 'Data',
            'DT_REGISTO' => 'Dt  Registo',
            'ESTADO' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAULA()
    {
        return $this->hasOne(SgdnRelAula::className(), ['ID' => 'AULA_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMODALIDADE()
    {
        return $this->hasOne(SgdnRelMaterialModalidade::className(), ['ID' => 'MODALIDADE_ID']);
    }
}
