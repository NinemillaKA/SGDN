<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sgdn_residencia".
 *
 * @property string $ID
 * @property string $SELF_ID
 * @property string $LOCALIDADE_ID
 * @property string $DESIG
 * @property string $DESCR
 * @property string $URL_LOGO
 * @property double $PRECO_DIA
 * @property double $VALOR
 * @property string $ENDERECO
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdnRelAlojamento[] $sgdnRelAlojamentos
 * @property SgdnRelContactos[] $sgdnRelContactos
 * @property SgdnRelResponsavel[] $sgdnRelResponsavels
 * @property GlbGeografia $lOCALIDADE
 * @property SgdnResidencia $sELF
 * @property SgdnResidencia[] $sgdnResidencias
 */
class SgdnResidencia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_residencia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'LOCALIDADE_ID', 'DESIG', 'DT_REGISTO', 'ESTADO'], 'required'],
            [['PRECO_DIA', 'VALOR'], 'number'],
            [['DT_REGISTO'], 'safe'],
            [['ID', 'SELF_ID'], 'string', 'max' => 36],
            [['LOCALIDADE_ID'], 'string', 'max' => 50],
            [['DESIG'], 'string', 'max' => 300],
            [['DESCR'], 'string', 'max' => 2000],
            [['URL_LOGO'], 'string', 'max' => 128],
            [['ENDERECO'], 'string', 'max' => 500],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
            [['LOCALIDADE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => GlbGeografia::className(), 'targetAttribute' => ['LOCALIDADE_ID' => 'ID']],
            [['SELF_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnResidencia::className(), 'targetAttribute' => ['SELF_ID' => 'ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'SELF_ID' => 'Self  ID',
            'LOCALIDADE_ID' => 'Localidade  ID',
            'DESIG' => 'Desig',
            'DESCR' => 'Descr',
            'URL_LOGO' => 'Url  Logo',
            'PRECO_DIA' => 'Preco  Dia',
            'VALOR' => 'Valor',
            'ENDERECO' => 'Endereco',
            'DT_REGISTO' => 'Dt  Registo',
            'ESTADO' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelAlojamentos()
    {
        return $this->hasMany(SgdnRelAlojamento::className(), ['RESIDENCIA_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelContactos()
    {
        return $this->hasMany(SgdnRelContactos::className(), ['REL_RESIDENCIA_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelResponsavels()
    {
        return $this->hasMany(SgdnRelResponsavel::className(), ['REL_RESIDENCIA_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLOCALIDADE()
    {
        return $this->hasOne(GlbGeografia::className(), ['ID' => 'LOCALIDADE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSELF()
    {
        return $this->hasOne(SgdnResidencia::className(), ['ID' => 'SELF_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnResidencias()
    {
        return $this->hasMany(SgdnResidencia::className(), ['SELF_ID' => 'ID']);
    }
}
