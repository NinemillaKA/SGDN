<?php

namespace backend\models;
use yii\base\UserException;

use Yii;

/**
 * This is the model class for table "sgdn_menu".
 *
 * @property string $ID
 * @property string $DESIG
 * @property string $DESCR
 * @property string $CONTROLLER
 * @property string $ESTADO
 * @property string $DT_REGISTO
 * @property string $DT_UPDATE
 * @property string $ACTION
 * @property int $FLAG_DISPLAY
 * @property string $MENU_ID
 *
 * @property SgdnRelPerfilMenu[] $sgdnRelPerfilMenus
 */
class SgdnMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sgdn_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'DESIG', 'ESTADO', 'DT_REGISTO', 'DT_UPDATE', 'MENU_ID'], 'required'],
            [['DT_REGISTO', 'DT_UPDATE'], 'safe'],
            [['FLAG_DISPLAY'], 'integer'],
            [['ID', 'MENU_ID'], 'string', 'max' => 36],
            [['DESIG', 'CONTROLLER'], 'string', 'max' => 250],
            [['DESCR'], 'string', 'max' => 2000],
            [['ESTADO'], 'string', 'max' => 1],
            [['ACTION'], 'string', 'max' => 45],
            [['ID'], 'unique'],
            // [['pg_menu_ID'], 'exist', 'skipOnError' => true, 'targetClass' => PgMenu::className(), 'targetAttribute' => ['pg_menu_ID' => 'ID']],
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
            'CONTROLLER' => 'Controller',
            'ESTADO' => 'Estado',
            'DT_REGISTO' => 'Dt  Registo',
            'DT_UPDATE' => 'Dt  Update',
            'ACTION' => 'Action',
            'FLAG_DISPLAY' => 'Flag  Display',
            'MENU_ID' => 'Menu  ID',
        ];
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    // public function getPgMenu()
    // {
    //     return $this->hasOne(PgMenu::className(), ['ID' => 'pg_menu_ID']);
    // }

    /**
     * @return \yii\db\ActiveQuery
     */
    // public function getPgMenus()
    // {
    //     return $this->hasMany(PgMenu::className(), ['pg_menu_ID' => 'ID']);
    // }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSgdnRelPerfilMenus()
    {
        return $this->hasMany(SgdnRelPerfilMenu::className(), ['MENU_ID' => 'ID']);
    }

    public function beforeSave($insert)
    {
    if (parent::beforeSave($insert)) {
        if($insert === true)
        {
            $this->DT_REGISTO = date('Y-m-d H:i:s');
            $this->ESTADO = "A";
            $this->ID = \Yii::$app->Helper->generate_uuid();
            if(empty($this->pg_menu_ID)){$this->pg_menu_ID = NULL;}
            ($this->FLAG_DISPLAY == "on")?$this->FLAG_DISPLAY = 1:$this->FLAG_DISPLAY = 0;
        }else{
            ($this->FLAG_DISPLAY == "on")?$this->FLAG_DISPLAY = 1:$this->FLAG_DISPLAY = 0;
             $this->DT_UPDATE = date('Y-m-d H:i:s');
        }

        return true;

    } else {
        return false;
    }
}




  /*


  Others functions!!!!	/**
	*generate database based sidebar menus for display
	*

	public function getMenuDisplay()
	{
		$menu = '';

		$root_menus = PgMenu::find()
					->where(['is', 'pg_menu_ID', NULL])
					->orderBy(['DESIG' => SORT_ASC])
					->all();

		foreach($root_menus as $root_menu) //ciclo menus pai
		{

			$child_menus = PgMenu::find()
					->where(['pg_menu_ID'=>$root_menu->ID,'FLAG_DISPLAY'=>true])
					->orderBy(['DESIG' => SORT_DESC])
					->all();

			if(count($child_menus)>0) //veirfica tem filhos
			{
				$sub_menu = '';
				$flag_isactive = false;

				foreach($child_menus as $child_menu) //ciclo filhos
				{
					//verifica se filho menu activo
					if(Yii::$app->controller->id == $child_menu->CONTROLLER && Yii::$app->controller->action->id == $child_menu->ACTION)
					{
						$active = 'active';
						$flag_isactive = true;
						$icon_highligth = 'style="color:#006cac"';
					}else{
						$active = '';
						$icon_highligth = '';
					}

					//verifica filho tem link
					if($child_menu->CONTROLLER !== '' && $child_menu->ACTION !== '')
					{
						$url = Url::to(['//'.$child_menu->CONTROLLER.'/'.$child_menu->ACTION.'']);
					}else{
						$url = '#';
					}

					if($child_menu->FLAG_DISPLAY)
					{
						$sub_menu .= '<li class="'.$active.'">';
						$sub_menu .= '<a href="'.$url.'"><span class="fa fa-angle-right" '.$icon_highligth.'></span><span class="xn-text">'.$child_menu->DESIG.'</span></a>';
						$sub_menu .= '</li>';
					}
				}
				//Se filho activo expande menu pai
				if($flag_isactive)
				{
					$menu .= '<li class="xn-openable active">';
				}else{
					$menu .= '<li class="xn-openable">';
				}

				$menu .= '<a href="#"><span class="fa fa-circle-o"></span><span class="xn-text">'.$root_menu->DESIG.'</span></a>';
				$menu .= '<ul>';
				$menu .= $sub_menu;
				$menu .= '</ul>';
				$menu .= '</li>';
			}else{ //caso pai não tenha filho

				if(Yii::$app->controller->id == $root_menu->CONTROLLER && Yii::$app->controller->action->id == $root_menu->ACTION)
				{
					$active = 'class="active"';
				}else{
					$active = '';
				}

				if($root_menu->CONTROLLER !== NULL )
				{
					$url = Url::to(['//'.$root_menu->CONTROLLER.'/'.$root_menu->ACTION.'']);
				}else{
					$url = '#';
				}

				$menu .= '<li '.$active.'>';
				$menu .= '<a href="'.$url.'"><span class="fa fa-circle-o"></span>'.$root_menu->DESIG.'</a>';
				$menu .= '</li>';
			}



		}

		$menu .= ' ';
		return $menu;
	}


	/**
	*generate database based sidebar menus for display
	*


	public function getPermisisons($id_perfil)
	{
		$menu = [];

		$root_menus = PgMenu::find()
					->where(['is', 'pg_menu_ID', NULL])
					//->andWhere(['TYPE'=>'folder'])
					->orderBy(['DESIG' => SORT_ASC])
					->all();
		$count_child_total = 0;
		foreach($root_menus as $root_menu) //ciclo menus pai
		{

			 $flag_has_child = $this->hasChild($root_menu);

			 if($flag_has_child)
			 {
				 $child_menu = $this->getPermissionsChilds($root_menu,$id_perfil);

				 $menu[] = [
					'text' =>$root_menu->DESIG.'<input type="hidden" value="'.$root_menu->ID.'"  name="permissions[]"\>',
					  'selectable' => false,
					  'nodes' => $child_menu,
					  'state' =>[
						'checked' => ($id_perfil !== NULL)?$this->checkPermission($root_menu->ID,$id_perfil):false,
						'selected'=>false,
						'expanded' => true,

					  ],
				];
			 }else{
				  $menu[] = [
					'text' =>$root_menu->DESIG.'<input type="hidden" value="'.$root_menu->ID.'"  name="permissions[]"\>',
					  'selectable' => false,
					  'state' =>[
						'checked' => ($id_perfil !== NULL)?$this->checkPermission($root_menu->ID,$id_perfil):false,
						'selected'=>false,
					  ],
				];
			 }

		}

		return $menu;
	}

	/**
	*

	protected function getPermissionsChilds($root_menu,$id_perfil)
	{
		$menu = [];

		$child_menus = PgMenu::find()
				->where(['pg_menu_ID'=>$root_menu->ID])
				->orderBy(['DESIG' => SORT_DESC])
				->all();

		foreach($child_menus as $child_menu) //ciclo filhos
		{
			 $flag_has_child = $this->hasChild($child_menu);

			 if($flag_has_child)
			 {
					$temp_childs = $this->getPermissionsChilds($child_menu,$id_perfil);
					/*if(count($temp_childs) > 0)
					{*
					$menu[] = [
						'text' =>$child_menu->DESIG.'<input type="hidden" value="'.$child_menu->ID.'" name="permissions[]"\>',
						'selectable' => false,
						'nodes' => $temp_childs,
						'state' =>[
							'checked' => ($id_perfil !== NULL)?$this->checkPermission($child_menu->ID,$id_perfil):false,
							'selected'=>false,
							'expanded' => false,
						  ],
					];
				}else{
					$menu[] = [
						'text' =>$child_menu->DESIG.'<input type="hidden" value="'.$child_menu->ID.'" name="permissions[]"\>',
						'selectable' => false,
						'state' =>[
							'checked' => ($id_perfil !== NULL)?$this->checkPermission($child_menu->ID,$id_perfil):false,
							'selected'=>false,
						  ],
					];
				}

		}

		return $menu;
	}

	/**
	*
	*
	protected function hasChild($root_menu)
	{
		$child_menus = PgMenu::find()
				->where(['pg_menu_ID'=>$root_menu->ID])
				->orderBy(['DESIG' => SORT_DESC])
				->all();

		return (count($child_menus) > 0)?true:false;
	}

	/**
	*
	*
	protected function checkPermission($id_menu,$id_perfil)
	{
		$has_permission = PgPerfilMenu::find()->where(['pg_menu_ID'=>$id_menu,'pg_perfil_ID'=>$id_perfil])->one();

		if($has_permission != NULL)
			return true;
		else return false;
	}




  */


}
