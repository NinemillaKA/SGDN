<?php

namespace backend\models;
use yii\base\UserException;

use Yii;
use yii\helpers\Url;

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
            [['DESIG','DESCR'], 'required'],
            [['DT_REGISTO', 'DT_UPDATE', 'FLAG_DISPLAY'], 'safe'],
            // [['FLAG_DISPLAY'], 'integer'],
            [['ID', 'MENU_ID'], 'string', 'max' => 36],
            [['DESIG', 'CONTROLLER'], 'string', 'max' => 250],
            [['DESCR'], 'string', 'max' => 2000],
            [['ESTADO'], 'string', 'max' => 1],
            [['ACTION'], 'string', 'max' => 100],
            [['ID'], 'unique'],
            // [['MENU_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SgdnMenu::className(), 'targetAttribute' => ['MENU_ID' => 'ID']],
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
    // public function getSgdnMenu()
    // {
    //     return $this->hasOne(SgdnMenu::className(), ['ID' => 'MENU_ID']);
    // }

    /**
     * @return \yii\db\ActiveQuery
     */
    // public function getSgdnMenus()
    // {
    //     return $this->hasMany(SgdnMenu::className(), ['MENU_ID' => 'ID']);
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
                if(empty($this->MENU_ID)){$this->MENU_ID = NULL;}
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
    Others functions!!!!
  	*generate database based sidebar menus for display
  	*/

  	public function getMenuDisplay()
  	{
  		$menu = [];

      $user = User::findOne(Yii::$app->user->ID);


      $user_menus = (new \yii\db\Query())
                      ->select('MENU_ID')
                      ->from('sgdn_rel_perfil_menu')
                      ->where(['PERFIL_ID'=> $user->sgdn_rel_perfil_ID]);
                      //->all();

      //$has_permission = SgdnRelPerfilMenu::find()->where(['PERFIL_ID'=>$user->pg_perfil_ID])->one();

  		$root_menus = SgdnMenu::find()
  					->where(['is', 'MENU_ID', NULL])
            ->andWHERE(['IN','ID',$user_menus])
  					->orderBy(['DESIG' => SORT_ASC])
  					->all();

  		foreach($root_menus as $root_menu) //ciclo menus pai
  		{
  			$child_menus = SgdnMenu::find()
  					->where(['MENU_ID'=>$root_menu->ID,'FLAG_DISPLAY'=>true])
            ->andWHERE(['IN','ID',$user_menus])
  					->orderBy(['DESIG' => SORT_DESC])
  					->all();

  			if(count($child_menus)>0) //veirfica tem filhos
  			{
  				$sub_menu = [];
  				$flag_isactive = false;

  				foreach($child_menus as $child_menu) //ciclo filhos
  				{

              $sub_menu = array_merge($sub_menu,$this->getSubMenuDisplay($child_menu, $user_menus));
  				}


          $menu[] =   [
                        'label' => $root_menu->DESIG,
                        'icon' => $root_menu->DESCR,
                        'url' => '#',
                        'items' => $sub_menu
                      ];
  			}else{ //caso pai não tenha filho

  				if($root_menu->CONTROLLER !== NULL )
    				{
    					$url = Url::to(['//'.$root_menu->CONTROLLER.'/'.$root_menu->ACTION.'']);
    				}else{
    					$url = '#';
    				}

            $menu[] =   [
                          'label' => $root_menu->DESIG,
                          'icon' => $root_menu->DESCR,
                          'url' => $url
                        ];
    			}
    		}

      //print_r($menu); \Yii::$app->end();
  		return $menu;
  	}

    /*
    *
    */
    protected function getSubMenuDisplay($root_menu,$user_menus)
    {
      $menu = [];

      $child_menus = SgdnMenu::find()
          ->where(['MENU_ID'=>$root_menu->ID,'FLAG_DISPLAY'=>true])
          ->andWHERE(['IN','ID',$user_menus])
          ->orderBy(['DESIG' => SORT_DESC])
          ->all();

      if(count($child_menus)>0) //veirfica tem filhos
      {
        $sub_menu = [];
        $flag_isactive = false;

        foreach($child_menus as $child_menu) //ciclo filhos
        {
            $sub_menu = array_merge($sub_menu,$this->getSubMenuDisplay($child_menu, $user_menus));
        }

        $menu[] =   [
                      'label' => $root_menu->DESIG,
                      'icon' => $root_menu->DESCR,
                      'url' => '#',
                      'items' => $sub_menu
                    ];
        }
        else{ //caso pai não tenha filho

  				if($root_menu->CONTROLLER !== NULL )
  				{
  					$url = Url::to(['//'.$root_menu->CONTROLLER.'/'.$root_menu->ACTION.'']);
  				}else{
  					$url = '#';
  				}


          $menu[] =   [
                        'label' => $root_menu->DESIG,
                        'icon' => $root_menu->DESCR,
                        'url' => $url
                      ];
  			}

        return $menu;
    }


  	/**
  	*generate database based sidebar menus for display
  	*/


  	public function getPermisisons($id_perfil)
  	{
  		$menu = [];

  		$root_menus = SgdnMenu::find()
  					->where(['is', 'MENU_ID', NULL])
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
  	*/

  	protected function getPermissionsChilds($root_menu,$id_perfil)
  	{
  		$menu = [];

  		$child_menus = SgdnMenu::find()
  				->where(['MENU_ID'=>$root_menu->ID])
  				->orderBy(['DESIG' => SORT_DESC])
  				->all();

  		foreach($child_menus as $child_menu) //ciclo filhos
  		{
  			 $flag_has_child = $this->hasChild($child_menu);

  			 if($flag_has_child)
  			 {
  					$temp_childs = $this->getPermissionsChilds($child_menu,$id_perfil);
  					/*if(count($temp_childs) > 0)
  					{*/
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
  	*/
  	protected function hasChild($root_menu)
  	{
  		$child_menus = SgdnMenu::find()
  				->where(['MENU_ID'=>$root_menu->ID])
  				->orderBy(['DESIG' => SORT_DESC])
  				->all();

  		return (count($child_menus) > 0)?true:false;
  	}

  	/**
  	*
  	*/
    protected function checkPermission($id_menu,$id_perfil)
    {
    	$has_permission = SgdnRelPerfilMenu::find()->where(['MENU_ID'=>$id_menu,'PERFIL_ID'=>$id_perfil])->one();

    	if($has_permission != NULL)
    		return true;
    	else return false;
    }

    public function getIconsList()
    {
      return [
              ['ID'=>'dashboard', 'VALUE'=>'dashboard'], //Dashboard
              ['ID'=>'fa-list-ul', 'VALUE'=>'fa-list-ul'], //Menu
              ['ID'=>'fa-smile-o', 'VALUE'=>'faf fa-smile-o'], //Perfil
              ['ID'=>'fa-user', 'VALUE'=>'fa-user'],

              ['ID'=>'fa-cog', 'VALUE'=>'fa-cog'], //parametrização
              ['ID'=>'fa-info-circle', 'VALUE'=>'fa-info-circle'], //Informacional
                  ['ID'=>'fa-envelope', 'VALUE'=>'fa-envelope'],//Contatos
                  ['ID'=>'fa-file-pdf-o', 'VALUE'=>'fa-file-pdf-o'], // Documentos
                  ['ID'=>'fa-street-view', 'VALUE'=>'fa-street-view'], // Estado Civil
              ['ID'=>'fa-wrench', 'VALUE'=>'fa-wrench'], // Materiais
                  ['ID'=>'fa-question', 'VALUE'=>'fa-question'], //Tipos
                  ['ID'=>'fa-slack', 'VALUE'=>'fa-slack'], //Marcas
                  ['ID'=>'fa-money', 'VALUE'=>'fa-money'], //Preçario
              ['ID'=>'fab fa-group', 'VALUE'=>'fa-group'], // Pessoas
              ['ID'=>'fa-anchor', 'VALUE'=>'fa-anchor'], // Spots
              ['ID'=>'fa-home', 'VALUE'=>'fa-home'], // Entidades && Alojamento
              ['ID'=>'fa-bank', 'VALUE'=>'fa-bank'], // Residencia

              ['ID'=>'fa-cubes', 'VALUE'=>'fa-cubes'], //Materiais

              ['ID'=>'fa-fa-bank', 'VALUE'=>'fa-bank'], // Escola
                  ['ID'=>'fa-xing', 'VALUE'=>'fa-xing'], // Modalidades
                  ['ID'=>'fa-leanpub', 'VALUE'=>'fa-leanpub'], // Aulas
                  ['ID'=>'fa-calendar', 'VALUE'=>'fa-calendar'], // Calendar
                  ['ID'=>'fa-user-plus', 'VALUE'=>'fa-user-plus'], //Alunos && Instructores


              ['ID'=>'fa-building', 'VALUE'=>'fa-building'], // Office
                  ['ID'=>'fa-plus-circle', 'VALUE'=>'fa-plus-circle'], // Cadastro
                  // ['ID'=>'', 'VALUE'=>'far fa-money'], // Matricula
                  ['ID'=>'fa-scissors', 'VALUE'=>'fa-scissors'], // Contracto
                  ['ID'=>'fa-exchange', 'VALUE'=>'fa-exchange'], // Aluguer
                  // ['ID'=>'', 'VALUE'=>'fa-fa-home'], //  Alojamento
                  ['ID'=>'fa-tree', 'VALUE'=>'fa-tree'], // Viagen
                  // ['ID'=>'', 'VALUE'=>'fal fa-tree'], // Inscricao Viagen
                  ['ID'=>'fa-user-secret', 'VALUE'=>'fa-user-secret'], // Responsavel Residencia

      ];
    }

}
