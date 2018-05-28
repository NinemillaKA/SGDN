<?php

namespace backend\controllers;

use Yii;
use backend\models\SgdnRelAluguer;
use backend\models\SgdnRelPrecario;
use app\models\Model;
use backend\models\SgdnRelAluguerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SgdnRelAluguerController implements the CRUD actions for SgdnRelAluguer model.
 */
class SgdnRelAluguerController extends Controller
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
        ];
    }

    /**
     * Lists all SgdnRelAluguer models.
     * @return mixed
     */

    public function actionGetPriceCalculator($id,$dthrini,$dthrfim)
    {
       /*$id = $_GET['id'];
       $datetime1 = $_GET['dtini'];
       $datetime2 = $_GET['dtfim'];*/

       // $datetime1 = new \DateTime($dthrini);
       // $datetime2 = new \DateTime($dthrfim);

       // $interval = $dthrfim->diff($datetime1);//->format("%a");

       $model = SgdnRelPrecario::find()->where(['ID' => $id])->one();

       $hourdiff = round((strtotime($dthrfim) - strtotime($dthrini))/3600, 1);

       //return print_r($hourdiff);

       $price  = $model->PRECO * $hourdiff ;

       echo $price;

    }

    public function actionIndex()
    {
        $searchModel = new SgdnRelAluguerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SgdnRelAluguer model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SgdnRelAluguer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $modelsSgdnRelAluger = [new SgdnRelAluguer()];

        if (Yii::$app->request->post()) {
          $modelsSgdnRelAluger = Model::createMultiple(SgdnRelAluguer::classname());

          Model::loadMultiple($modelsSgdnRelAluger, Yii::$app->request->post());


          $valid = SgdnRelAluguer::validateMultiple($modelsSgdnRelAluger);

          if ($valid) {

              try{
                    $flag = false;
                    foreach ($modelsSgdnRelAluger as $key => $modelSgdnRelAluger) {
                        $modelSgdnRelAluger->PESSOA_ID = $_POST['pessoa_id'];
                        $flag = $modelSgdnRelAluger->save();
                        if (!$flag) {

                            print_r($model->errors);

                              echo "5";
                            \Yii::$app->end();
                            break;
                        }
                    }

                } catch (Exception $e) {
                      echo "2";

                    \Yii::$app->end();
                }

                return $this->redirect(['index']);
          }else{
            // print_r($model->errors);
            \Yii::$app->end();
          }


        }

        return $this->renderAjax('create', [
            //'model' => $model,
            'modelsSgdnRelAluger' => $modelsSgdnRelAluger,
        ]);
    }

    /**
     * Updates an existing SgdnRelAluguer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        }

        return $this->renderAjax('update', [
            'model' => $model,
            'modelsSgdnRelAluger' => $modelsSgdnRelAluger,
        ]);
    }

    /**
     * Deletes an existing SgdnRelAluguer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        return $this->redirect(['index']);
    }

    /**
     * Finds the SgdnRelAluguer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SgdnRelAluguer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SgdnRelAluguer::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
