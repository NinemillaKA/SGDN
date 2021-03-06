<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sgdn_rel_perfil".
 *
 * @property string $ID
 * @property string $DESIG
 * @property string $DESCR
 * @property string $ESTADO
 * @property string $DT_REGISTO
 * @property string $DT_UPDATE
 *
 * @property SgdnRelPerfilMenu[] $sgdnRelPerfilMenus
 */
class SgdnRelPerfil extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_rel_perfil';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DESIG'], 'required'],
            [['DT_REGISTO', 'DT_UPDATE'], 'safe'],
            [['ID'], 'string', 'max' => 36],
            [['DESIG'], 'string', 'max' => 250],
            [['DESCR'], 'string', 'max' => 2000],
            [['ESTADO'], 'string', 'max' => 1],
            [['ID'], 'unique']
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
            'ESTADO' => 'Estado',
            'DT_REGISTO' => 'Dt  Registo',
            'DT_UPDATE' => 'Dt  Update',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelPerfilMenus()
    {
        return $this->hasMany(SgdnRelPerfilMenu::className(), ['PERFIL_ID' => 'ID']);
    }

    public function beforeSave($insert)
	  {
    		if (parent::beforeSave($insert)) {
        			if($insert === true)
        			{
          				$this->DT_REGISTO = date('Y-m-d H:i:s');
          				$this->ESTADO = "A";
          				$this->ID = \Yii::$app->Helper->generate_uuid();
        			}else{
    				      $this->DT_UPDATE = date('Y-m-d H:i:s');
    			    }
    			    return true;
    		} else {
    		      return false;
    		}
	  }

	public function afterSave($insert, $changedAttributes){
		parent::afterSave($insert, $changedAttributes);

	 		if($insert === false)
			{
				$permissions_old = SgdnRelPerfilMenu::find()
									->where(['PERFIL_ID'=>$this->ID])
									->all();
				foreach($permissions_old as $permission_old)
				{
					$permission_old->delete();
				}
			}

			if(isset($_POST['cheched_permissions']))
			{
				for($i=0; $i<count($_POST['cheched_permissions']);$i++)
				{
					$permission = new SgdnRelPerfilMenu();
					$permission->ID = \Yii::$app->Helper->generate_uuid();
					$permission->PERFIL_ID = $this->ID;
					$permission->MENU_ID =  $_POST['cheched_permissions'][$i];

					if(!$permission->save())
					{
						print_r($permission->errors);
						Yii::$app->end();
					}

				}
			}

			return true;
	}


	// public function beforeDelete()
	// {
	// 	if (parent::beforeDelete()) {
  //
	// 		if(count($this->pgUsers) > 0)
	// 		{
	// 			throw new UserException(Yii::t('app', 'This profile has user associated to it.Must delete the users first.'));
	// 		}
  //
  //
	// 		foreach($this->SgdnRelPerfilMenus as $permissao)
	// 		{
	// 			$permissao->delete();
	// 		}
  //
	// 		return true;
	// 	} else {
	// 		return false;
	// 	}
	// }


}
