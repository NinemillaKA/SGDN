<?php

namespace backend\models;

use Yii;
use \Faker\Provider\Uuid;

/**
 * This is the model class for table "sgdn_rel_documentos".
 *
 * @property string $ID
 * @property string $PR_DOCUMENTO_TP_ID
 * @property string $ENTIDADE_ID
 * @property string $REL_MATRICULA_ID
 * @property string $PESSOA_ID
 * @property string $REL_INSTRUTOR_MODALIDADE_ID
 * @property string $NUMERO
 * @property string $URL_DOCUMENTO
 * @property string $DT_EMISSAO
 * @property string $DT_VALIDADE
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdnEntidade $eNTIDADE
 * @property SgdnPrDocumentoTp $pRDOCUMENTOTP
 * @property SgdnPessoa $pESSOA
 * @property SgdnRelInstrutorModalidade $rELINSTRUTORMODALIDADE
 * @property SgdnRelMatricula $rELMATRICULA
 */
class SgdnRelDocumentos extends \yii\db\ActiveRecord
{
    public $docfile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_rel_documentos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PR_DOCUMENTO_TP_ID', 'NUMERO'], 'required'],
            [['DT_EMISSAO', 'DT_VALIDADE', 'DT_REGISTO'], 'safe'],
            [['ID', 'PR_DOCUMENTO_TP_ID', 'ENTIDADE_ID', 'REL_MATRICULA_ID', 'PESSOA_ID', 'REL_INSTRUTOR_MODALIDADE_ID'], 'string', 'max' => 36],
            [['NUMERO'], 'string', 'max' => 25],
            [['URL_DOCUMENTO'], 'string', 'max' => 128],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
            [['ENTIDADE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnEntidade::className(), 'targetAttribute' => ['ENTIDADE_ID' => 'ID']],
            [['PR_DOCUMENTO_TP_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnPrDocumentoTp::className(), 'targetAttribute' => ['PR_DOCUMENTO_TP_ID' => 'ID']],
            [['PESSOA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnPessoa::className(), 'targetAttribute' => ['PESSOA_ID' => 'ID']],
            [['REL_INSTRUTOR_MODALIDADE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnRelInstrutorModalidade::className(), 'targetAttribute' => ['REL_INSTRUTOR_MODALIDADE_ID' => 'ID']],
            [['docfile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, pdf, rar ', 'checkExtensionByMimeType'=>false, 'maxFiles' => 1],
            [['REL_MATRICULA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnRelMatricula::className(), 'targetAttribute' => ['REL_MATRICULA_ID' => 'ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'PR_DOCUMENTO_TP_ID' => 'Pr  Documento  Tp  ID',
            'ENTIDADE_ID' => 'Entidade  ID',
            'REL_MATRICULA_ID' => 'Rel  Matricula  ID',
            'PESSOA_ID' => 'Pessoa  ID',
            'REL_INSTRUTOR_MODALIDADE_ID' => 'Rel  Instrutor  Modalidade  ID',
            'NUMERO' => 'Numero',
            'URL_DOCUMENTO' => 'Url  Documento',
            'DT_EMISSAO' => 'Dt  Emissao',
            'DT_VALIDADE' => 'Dt  Validade',
            'DT_REGISTO' => 'Dt  Registo',
            'ESTADO' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getENTIDADE()
    {
        return $this->hasOne(SgdnEntidade::className(), ['ID' => 'ENTIDADE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPRDOCUMENTOTP()
    {
        return $this->hasOne(SgdnPrDocumentoTp::className(), ['ID' => 'PR_DOCUMENTO_TP_ID']);
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
    public function getRELINSTRUTORMODALIDADE()
    {
        return $this->hasOne(SgdnRelInstrutorModalidade::className(), ['ID' => 'REL_INSTRUTOR_MODALIDADE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRELMATRICULA()
    {
        return $this->hasOne(SgdnRelMatricula::className(), ['ID' => 'REL_MATRICULA_ID']);
    }

    public function beforeSave($insert)
    {
        if ($insert) {

            $this->ID = Uuid::uuid();
            $this->DT_REGISTO = date('Y-m-d h:m:s');
            $this->ESTADO = 'A';
            $this->DT_EMISSAO = date("Y-m-d",strtotime($this->DT_EMISSAO));
            $this->DT_VALIDADE = date("Y-m-d",strtotime($this->DT_VALIDADE));
              return true;
        }else{
          $this->DT_EMISSAO = date("Y-m-d",strtotime($this->DT_EMISSAO));
          $this->DT_VALIDADE = date("Y-m-d",strtotime($this->DT_VALIDADE));

        }
        return parent::beforeSave($insert);
    }

    public function afterFind(){

        parent::afterFind();
        $this->DT_EMISSAO = date("d-m-Y",strtotime($this->DT_EMISSAO));
        $this->DT_VALIDADE = date("d-m-Y",strtotime($this->DT_VALIDADE));
    }
}
