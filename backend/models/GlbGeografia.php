<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "glb_geografia".
 *
 * @property string $ID
 * @property string $NOME
 * @property string $ZONA
 * @property string $FREGUESIA
 * @property string $CONCELHO
 * @property string $ILHA
 * @property string $PAIS
 * @property string $GLB_GEOG_ID
 * @property string $NIVEL_DETALHE
 * @property string $NACIONALIDADE
 * @property string $NOME_OFICIAL
 * @property string $FLAG_ALTER
 * @property string $NOME_NORM
 * @property string $TP_GEOG_CD
 * @property string $FLG_SITUACAO
 * @property string $CODIGO_INE
 * @property string $CODIGO
 *
 * @property SgdnEntidade[] $sgdnEntidades
 * @property SgdnPessoa[] $sgdnPessoas
 * @property SgdnPessoa[] $sgdnPessoas0
 * @property SgdnResidencia[] $sgdnResidencias
 * @property SgdnSpot[] $sgdnSpots
 */
class GlbGeografia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'glb_geografia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'GLB_GEOG_ID'], 'required'],
            [['ID', 'NOME', 'ZONA', 'FREGUESIA', 'CONCELHO', 'ILHA', 'PAIS', 'GLB_GEOG_ID', 'CODIGO'], 'string', 'max' => 50],
            [['NIVEL_DETALHE'], 'string', 'max' => 2],
            [['NACIONALIDADE'], 'string', 'max' => 100],
            [['NOME_OFICIAL', 'NOME_NORM'], 'string', 'max' => 300],
            [['FLAG_ALTER', 'FLG_SITUACAO'], 'string', 'max' => 1],
            [['TP_GEOG_CD'], 'string', 'max' => 4],
            [['CODIGO_INE'], 'string', 'max' => 20],
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
            'NOME' => 'Zona',
            'ZONA' => 'Zona',
            'FREGUESIA' => 'Freguesia',
            'CONCELHO' => 'Concelho',
            'ILHA' => 'Ilha',
            'PAIS' => 'Pais',
            'GLB_GEOG_ID' => 'Glb  Geog  ID',
            'NIVEL_DETALHE' => 'Nivel  Detalhe',
            'NACIONALIDADE' => 'Nacionalidade',
            'NOME_OFICIAL' => 'Nome  Oficial',
            'FLAG_ALTER' => 'Flag  Alter',
            'NOME_NORM' => 'Nome  Norm',
            'TP_GEOG_CD' => 'Tp  Geog  Cd',
            'FLG_SITUACAO' => 'Flg  Situacao',
            'CODIGO_INE' => 'Codigo  Ine',
            'CODIGO' => 'Codigo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnEntidades()
    {
        return $this->hasMany(SgdnEntidade::className(), ['GLB_GEOGRAFIA_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnPessoas()
    {
        return $this->hasMany(SgdnPessoa::className(), ['NATURALIDADE_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnPessoas0()
    {
        return $this->hasMany(SgdnPessoa::className(), ['LOCALIDADE_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnResidencias()
    {
        return $this->hasMany(SgdnResidencia::className(), ['LOCALIDADE_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnSpots()
    {
        return $this->hasMany(SgdnSpot::className(), ['GEOGRAFIA_ID' => 'ID']);
    }
}
