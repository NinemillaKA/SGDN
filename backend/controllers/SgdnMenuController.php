<?php

namespace backend\controllers;

use Yii;
use backend\models\SgdnMenu;
use backend\models\SgdnMenuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SgdnMenuController implements the CRUD actions for SgdnMenu model.
 */
class SgdnMenuController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            // 'access' => [
            //                'class' => \yii\filters\AccessControl::className(),
            //                'rules' => [
            //                    [
            //                        'allow' => true,
            //                        'matchCallback' => function ($rule, $action) {
    				// 					return \Yii::$app->Helper->checkAccess($this->id,$action->id);
    				// 				}
            //                    ],
            //                ],
            //            ],
         ];
    }


    /**
*
*
*/
public function actionGetPermissions()
{
  $id_perfil = $_POST['id_perfil']; // !!!

  if($id_perfil == '')
  {
    $id_perfil = NULL;
  }
  return json_encode(\Yii::$app->Helper->permissionsTree($id_perfil));
}


 /**
   * get controller actions list
   * @param string $controller_id
   * @return mixed
   */
  public function actionGetControllerActions()
  {
       if ($controller_id = Yii::$app->request->post('controller_id')) {
        $actions = \Yii::$app->Helper->getActions($controller_id);

            if ($actions > 0) {
                foreach ($actions as $key=>$value){
                    print_r($value);
                    echo "<option value='" . $value . "'>" . $value . "</option>";
                }
            } else{
                  echo "<option>-</option>";
            }
      }

  }

    /**
     * Lists all SgdnMenu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SgdnMenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SgdnMenu model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SgdnMenu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SgdnMenu();
        $controllers = \Yii::$app->Helper->getControllers();

        if ($model->load(Yii::$app->request->post())) {

            if($model->save()){

              Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your registry is saved.'));
              return $this->redirect(['index']);
            }else{
              print_r($model->errors);
              var_dump($model->FLAG_DISPLAY);
              \Yii::$app->end();
            }

            // return $this->redirect(['view', 'id' => $model->ID]);
        }elseif(Yii::$app->request->isAjax){
          return $this->renderAjax('create', [
                 'model' => $model,
                 'controllers' => $controllers
          ]);
        }
    }

    /**
     * Updates an existing SgdnMenu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $controllers = \Yii::$app->Helper->getControllers();
        $actions = \Yii::$app->Helper->getActions($model->CONTROLLER);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your registry is updated.'));
            return $this->redirect(['index']);
        }elseif(Yii::$app->request->isAjax){
            return $this->renderAjax('update', [
                   'model' => $model,
                   'controllers' => $controllers,
                   'actions' => $actions,
            ]);
        // }else{
        //     return $this->renderAjax('update', [
        //            'model' => $model,
        //            'controllers' => $controllers
        //     ]);
        }
    }

    /**
     * Deletes an existing SgdnMenu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SgdnMenu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SgdnMenu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SgdnMenu::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
