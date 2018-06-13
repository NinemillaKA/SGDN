<?php

namespace backend\models;

use Yii;
use \Faker\Provider\Uuid;


/**
 * This is the model class for table "sgdn_pessoa".
 *
 * @property string $ID
 * @property string $NATURALIDADE_ID
 * @property string $LOCALIDADE_ID
 * @property string $PR_ESTADO_CIVIL_ID
 * @property string $NOME
 * @property string $DT_NASC
 * @property string $SEXO
 * @property string $MORADA
 * @property string $URL_FOTO
 * @property string $DT_REGISTO
 * @property string $ESTADO
 * @property string $SGDN_PESSOA_ID
 *
 * @property SgdmInstrutor[] $sgdmInstrutors
 * @property GlbGeografia $nATURALIDADE
 * @property GlbGeografia $lOCALIDADE
 * @property SgdnPessoa $sGDNPESSOA
 * @property SgdnPessoa[] $sgdnPessoas
 * @property SgdnPrEstadoCivil $pRESTADOCIVIL
 * @property SgdnRelAlojamento[] $sgdnRelAlojamentos
 * @property SgdnRelAluguer[] $sgdnRelAluguers
 * @property SgdnRelContactos[] $sgdnRelContactos
 * @property SgdnRelDocumentos[] $sgdnRelDocumentos
 * @property SgdnRelMatricula[] $sgdnRelMatriculas
 * @property SgdnRelPessoaEndereco[] $sgdnRelPessoaEnderecos
 * @property SgdnRelResponsavel[] $sgdnRelResponsavels
 */
class SgdnPessoa extends \yii\db\ActiveRecord
{

   public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_pessoa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NATURALIDADE_ID', 'LOCALIDADE_ID', 'PR_ESTADO_CIVIL_ID', 'NOME', 'DT_NASC', 'SEXO'], 'required'],
            [['DT_NASC', 'DT_REGISTO'], 'safe'],
            [['ID', 'PR_ESTADO_CIVIL_ID', 'SGDN_PESSOA_ID'], 'string', 'max' => 36],
            [['NATURALIDADE_ID', 'LOCALIDADE_ID'], 'string', 'max' => 50],
            [['NOME'], 'string', 'max' => 300],
            [['SEXO', 'ESTADO'], 'string', 'max' => 1],
            [['MORADA'], 'string', 'max' => 250],
            [['URL_FOTO'], 'string', 'max' => 128],
            [['ID'], 'unique'],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'checkExtensionByMimeType'=>false, 'maxFiles' => 1],
            [['NATURALIDADE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => GlbGeografia::className(), 'targetAttribute' => ['NATURALIDADE_ID' => 'ID']],
            [['LOCALIDADE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => GlbGeografia::className(), 'targetAttribute' => ['LOCALIDADE_ID' => 'ID']],
            [['SGDN_PESSOA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnPessoa::className(), 'targetAttribute' => ['SGDN_PESSOA_ID' => 'ID']],
            [['PR_ESTADO_CIVIL_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnPrEstadoCivil::className(), 'targetAttribute' => ['PR_ESTADO_CIVIL_ID' => 'ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'NATURALIDADE_ID' => 'Nacionalidade',
            'LOCALIDADE_ID' => 'Localidade  ID',
            'PR_ESTADO_CIVIL_ID' => 'Pr  Estado  Civil  ID',
            'NOME' => 'Nome',
            'DT_NASC' => 'Dt  Nasc',
            'SEXO' => 'Sexo',
            'MORADA' => 'Morada',
            'URL_FOTO' => 'Url  Foto',
            'DT_REGISTO' => 'Dt  Registo',
            'ESTADO' => 'Estado',
            'SGDN_PESSOA_ID' => 'Sgdn  Pessoa  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdmInstrutors()
    {
        return $this->hasMany(SgdmInstrutor::className(), ['PESSOA_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNATURALIDADE()
    {
        return $this->hasOne(GlbGeografia::className(), ['ID' => 'NATURALIDADE_ID']);
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
    public function getSGDNPESSOA()
    {
        return $this->hasOne(SgdnPessoa::className(), ['ID' => 'SGDN_PESSOA_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnPessoas()
    {
        return $this->hasMany(SgdnPessoa::className(), ['SGDN_PESSOA_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPRESTADOCIVIL()
    {
        return $this->hasOne(SgdnPrEstadoCivil::className(), ['ID' => 'PR_ESTADO_CIVIL_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelAlojamentos()
    {
        return $this->hasMany(SgdnRelAlojamento::className(), ['PESSOA_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelAluguers()
    {
        return $this->hasMany(SgdnRelAluguer::className(), ['PESSOA_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelContactos()
    {
        return $this->hasMany(SgdnRelContactos::className(), ['PESSOA_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelDocumentos()
    {
        return $this->hasMany(SgdnRelDocumentos::className(), ['PESSOA_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelMatriculas()
    {
        return $this->hasMany(SgdnRelMatricula::className(), ['ALUNO_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelPessoaEnderecos()
    {
        return $this->hasMany(SgdnRelPessoaEndereco::className(), ['PESSOA_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelResponsavels()
    {
        return $this->hasMany(SgdnRelResponsavel::className(), ['PESSOA_ID' => 'ID']);
    }

    public function beforeSave($insert)
    {
        if ($insert) {

            $this->DT_NASC = date("Y-m-d",strtotime($this->DT_NASC));
            $this->ID = Uuid::uuid();
            $this->DT_REGISTO = date('Y-m-d h:m:s');
            $this->ESTADO = 'A';

              return true;

        }else{

                $this->DT_NASC = date("Y-m-d",strtotime($this->DT_NASC));
        }
        return parent::beforeSave($insert);
      }

      public function afterFind(){ //inverter data

          parent::afterFind();
          $this->DT_NASC = date("d-m-Y",strtotime($this->DT_NASC));
      }

      public function dataNascimento () {
          // Return the number of days between the two dates:

            //return round((abs(strtotime( $this->DT_NASC)-strtotime(time()))/86400)/365);
            // $date = new Date($this->DT_NASC);
            $bday = $this->DT_NASC;
            $now =  date('Y-m-d H:i:s');
            // $interval = $now->diff($date);
            $interval = round((strtotime($bday) - strtotime($now))/3600, 1);
            return $interval;

            // $date1=date($this->DT_NASC);
            // $now=date();
            //
            // $date_diff=strtotime($date2)-strtotime($date1);
            // return floor(($date_diff)/(60*60*24*365));

          }
}
