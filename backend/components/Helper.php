<?php
/**
* Components
*
*
**/
namespace backend\components;


use Yii;
use yii\helpers\Url;
use yii\base\Component;
use yii\base\InvalidConfigException;
use backend\models\SgdnMenu;
use backend\models\SgdnRelPerfilMenu;
use backend\models\User;

class Helper extends Component
{
	 /*
	 * Generates Unique ID for models
	 */
	 function generate_uuid() {
		return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
			mt_rand( 0, 0xffff ),
			mt_rand( 0, 0x0fff ) | 0x4000,
			mt_rand( 0, 0x3fff ) | 0x8000,
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
		);
	}


	/**
	*
	*
	*/
	function getControllers()
	{
		$controllerlist = [];
		if ($handle = opendir('../controllers')) {
			while (false !== ($file = readdir($handle))) {
				if ($file != "." && $file != ".." && substr($file, strrpos($file, '.') - 10) == 'Controller.php') {
					$controller_name = lcfirst(str_replace("Controller.php","",$file));
					$controller_name = strtolower(preg_replace('/([A-Z]+)/', "-$1", $controller_name));
					$controllerlist[$controller_name] = $controller_name;
				}
			}
			closedir($handle);
		}
		asort($controllerlist);
		/*$fulllist = [];
		foreach ($controllerlist as $controller):
			$handle = fopen('../controllers/' . $controller, "r");
			if ($handle) {
				while (($line = fgets($handle)) !== false) {
					if (preg_match('/public function action(.*?)\(/', $line, $display)):
						if (strlen($display[1]) > 2):
							$fulllist[substr($controller, 0, -4)][] = strtolower($display[1]);
						endif;
					endif;
				}
			}
			fclose($handle);
		endforeach;*/
		return $controllerlist;
	}


	/**
	*
	*
	*/
	function getActions($controller)
	{
		$controllerlist = [];
		if ($handle = opendir('../controllers')) {
			while (false !== ($file = readdir($handle))) {
				if ($file != "." && $file != ".." && substr($file, strrpos($file, '.') - 10) == 'Controller.php') {
					$controller_name = lcfirst(str_replace("Controller.php","",$file));
					$controller_name = strtolower(preg_replace('/([A-Z]+)/', "-$1", $controller_name));

					if($controller_name == $controller)
					{
						$fulllist = [];

						$handle_actions = fopen('../controllers/' . $file, "r");
						if ($handle_actions) {
							while (($line = fgets($handle_actions)) !== false) {
								if (preg_match('/public function action(.*?)\(/', $line, $display)):
									if (strlen($display[1]) > 2):
										$action_name = strtolower(preg_replace('/([A-Z]+)/', "-$1", lcfirst($display[1])));
										$fulllist[$action_name] = $action_name;//strtolower($display[1]);
									endif;
								endif;
							}
						}
						fclose($handle_actions);
						closedir($handle);
						return $fulllist;
					}
				}
			}
			closedir($handle);
		}

	}


	/**
	*
	*
	*/
	function displayMenu()
	{
		$model = new SgdnMenu();
		return $model->getMenuDisplay();
	}

	/**
	*
	*
	*/
	function permissionsTree($id_perfil = NULL)
	{
		$model = new SgdnMenu();
		return $model->getPermisisons($id_perfil);
	}

	/**
	*
	*
	*/
	function checkAccess($controller_id, $action_id)
	{

		$menu = SgdnMenu::find()->where(['ACTION'=>$action_id, 'CONTROLLER'=>$controller_id])->one();
		$user = User::findOne(Yii::$app->user->ID);

		if($menu !== NULL && $user!==NULL)
		{
			$has_permission = SgdnRelPerfilMenu::find()->where(['MENU_ID'=>$menu->ID,'pg_perfil_ID'=>$user->pg_perfil_ID])->one();

			if($has_permission != NULL)
				return true;
			else return false;
		}else
		{
				return false;
		}
	}

	/**
	*
	*
	*/
	function getbreadscrumb()
	{
		$breadscrumb = [];
		$controller_id = Yii::$app->controller->id;
		$action_id = 	Yii::$app->controller->action->id;

		$current_menu = SgdnMenu::find()->where(['ACTION'=>$action_id, 'CONTROLLER'=>$controller_id])->one();

		if($current_menu !== NULL)
		{
			$parent = $current_menu->SgdnMenu;
			if($parent !== NULL)
			{
				if($parent->CONTROLLER !== '' && $parent->ACTION !== '')
				{
					$item = [['label'=>$parent->DESIG,'url'=>['//'.$parent->CONTROLLER.'/'.$parent->ACTION.'']]];
				}else{
					$item = [['label'=>$parent->DESIG]];
				}
				$breadscrumb = array_merge($breadscrumb, $item);
			}

			return array_merge($breadscrumb, [['label'=>$current_menu->DESIG]]);
		}
		return false;
	}

	/**
	*
	*
	*/
	function getPageTitle()
	{
		$controller_id = Yii::$app->controller->id;
		$action_id = 	Yii::$app->controller->action->id;

		$current_menu = SgdnMenu::find()->where(['ACTION'=>$action_id, 'CONTROLLER'=>$controller_id])->one();

		if($current_menu !== NULL)
		{
			return $current_menu->DESIG;
		}else{
			return '';
		}
	}
}
?>
