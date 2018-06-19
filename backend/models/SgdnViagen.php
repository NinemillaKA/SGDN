<?php

namespace backend\models;

use Yii;
use \Faker\Provider\Uuid;

/**
 * This is the model class for table "sgdn_viagen".
 *
 * @property string $ID
 * @property string $CODIGO
 * @property string $URL_IMAGEM
 * @property string $DESIG
 * @property string $DESCR
 * @property string $GEOGRAFIA_ID
 * @property string $ENDERECO
 * @property string $CORD_ORIGIN
 * @property string $CORD_DESTINY
 * @property string $DT_INICIO
 * @property string $DT_FIM
 * @property double $PRECO
 * @property string $DT_REGISTO
 * @property string $ESTADO
 *
 * @property SgdnRelInscricaoViagen[] $sgdnRelInscricaoViagens
 * @property SgdnRelViagenInstrutor[] $sgdnRelViagenInstrutors
 * @property GlbGeografia $gEOGRAFIA
 */

 // class SearchLocation extends \yii\base\Model
 // {
 //     public $address;
 //     public $longitude;
 //     public $latitude;
 // }

class SgdnViagen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_viagen';
    }

    /**
     * @inheritdoc
     */
    public $file;

    public $address;
    public $longitude;
    public $latitude;

    public $address2;
    public $longitude2;
    public $latitude2;

    public function rules()
    {
        return [
            [['CODIGO', 'DESIG', 'GEOGRAFIA_ID', 'DT_INICIO',], 'required'],
            [['DT_INICIO', 'DT_FIM', 'DT_REGISTO'], 'safe'],
            [['PRECO'], 'number'],
            [['ID'], 'string', 'max' => 36],
            [['CODIGO'], 'string', 'max' => 5],
            [['URL_IMAGEM'], 'string', 'max' => 128],
            [['DESIG', 'ENDERECO'], 'string', 'max' => 300],
            [['DESCR', 'CORD_ORIGIN', 'CORD_DESTINY'], 'string', 'max' => 2000],
            [['GEOGRAFIA_ID'], 'string', 'max' => 50],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique'],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'checkExtensionByMimeType'=>false, 'maxFiles' => 1],
            [['GEOGRAFIA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => GlbGeografia::className(), 'targetAttribute' => ['GEOGRAFIA_ID' => 'ID']],
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
            'URL_IMAGEM' => 'Url  Imagem',
            'DESIG' => 'Desig',
            'DESCR' => 'Descr',
            'GEOGRAFIA_ID' => 'Geografia  ID',
            'ENDERECO' => 'Endereco',
            'CORD_ORIGIN' => 'Cord Origin',
            'CORD_DESTINY' => 'Cord Destiny',
            'DT_INICIO' => 'Dt  Inicio',
            'DT_FIM' => 'Dt  Fim',
            'PRECO' => 'Preco',
            'DT_REGISTO' => 'Dt  Registo',
            'ESTADO' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelInscricaoViagens()
    {
        return $this->hasMany(SgdnRelInscricaoViagen::className(), ['VIAGEM_ID' => 'ID']);
    }

   /**
     * @return \yii\db\ActiveQuery
     */
     public function getSgdnRelViagenInstrutors()
     {
       return $this->hasMany(SgdnRelViagenInstrutor::className(), ['VIAGEM_ID' => 'ID']);
     }

   /**
    * @return \yii\db\ActiveQuery
    */
    public function getGEOGRAFIA()
    {
        return $this->hasOne(GlbGeografia::className(), ['ID' => 'GEOGRAFIA_ID']);
    }

    public function beforeSave($insert)
    {
            if ($insert) {

              $this->ID = Uuid::uuid();
              $this->DT_REGISTO = date('Y-m-d h:m:s');
              $this->ESTADO = 'A';

                return true;
             }

            return parent::beforeSave($insert);
    }
}
