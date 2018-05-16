<?php

namespace backend\controllers;

use Yii;
use backend\models\SgdnRelPrecario;
use backend\models\SgdnRelPrecarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Model;
use backend\models\SgdnRelMaterialModalidade;

/**
 * SgdnRelPrecarioController implements the CRUD actions for SgdnRelPrecario model.
 */
class SgdnRelPrecarioController extends Controller
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
     * Lists all SgdnRelPrecario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SgdnRelPrecarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SgdnRelPrecario model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        // $model = findModel($this->$id);
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SgdnRelPrecario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        //$model = new SgdnRelPrecario();
        $modelsMaterialModalidade =  [new SgdnRelPrecario];

        if (Yii::$app->request->post()) {

            $modelsMaterialModalidade = Model::createMultiple(SgdnRelPrecario::classname());
            Model::loadMultiple($modelsMaterialModalidade, Yii::$app->request->post());
            // $valid = $model->validate();
            $valid = SgdnRelPrecario::validateMultiple($modelsMaterialModalidade) /*&& $valid*/;
            $valid=true;
            if($valid){

                $transaction = \Yii::$app->db->beginTransaction();
                try{

                    //  if ($flag = $model->save(false)) {
                          $flag = false;
                          foreach ($modelsMaterialModalidade as $key => $modelMaterialModalidade) {

                                //gyardar rel material modalidade
                                $model_mat_mod = new SgdnRelMaterialModalidade();
                                $model_mat_mod->MATERIAL_ID = $modelMaterialModalidade->REL_MATERIAL_MODALIDADE_ID;
                                $model_mat_mod->MODALIDADE_ID = $_POST['MODALIDADE_ID'][$key];

                                if($model_mat_mod->save())
                                {
                                  $modelMaterialModalidade->REL_MATERIAL_MODALIDADE_ID = $model_mat_mod->ID;

                                  if (! ($flag = $modelMaterialModalidade->save(false))) {

                                      print_r($modelMaterialModalidade->errors);
                                      $transaction->rollBack();
                                        echo "5";
                                      \Yii::$app->end();
                                      break;
                                  }

                                }else{
                                    echo "6";
                                    print_r ($model_mat_mod->errors);\Yii::$app->end();
                                }
                          }

                  } catch (Exception $e) {
                        echo "2";
                      $transaction->rollBack();
                      \Yii::$app->end();
                  }

                  if($flag){
                      $transaction->commit();
                      echo "3";
                      return $this->redirect(['index']);
                  }else{
                      echo "4";\Yii::$app->end();
                    //  print_r ($model->errors);
                  }

                return $this->redirect(['index']);
            }else{
                echo "5";var_dump($valid);\Yii::$app->end();
              //  print_r ($model->errors);
            }

        }

        return $this->renderAjax('create', [
            //'model' => $model,
            'modelMaterialModalidade' => $modelsMaterialModalidade,
        ]);

    }

    /**
     * Updates an existing SgdnRelPrecario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
      $model = $this->findModel($id);

     if ($model->load(Yii::$app->request->post()) && $model->save()) {
         return $this->redirect(['index']);
     }

     return $this->renderAjax('_form_item', [
         'model' => $model,
     ]);
    }

    /**
     * Deletes an existing SgdnRelPrecario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        // ($model->ESTADO == 'I') ? $model->ESTADO = 'A' : $model->ESTADO = 'I';
        ($model->ESTADO == 'A') ? $model->ESTADO = 'I' : $model->ESTADO = 'A';

        return $this->redirect(['index']);
    }

    /**
     * Finds the SgdnRelPrecario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SgdnRelPrecario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SgdnRelPrecario::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
