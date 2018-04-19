<?php

namespace backend\controllers;

use Yii;
use backend\models\SgdnPrContactoTp;
use backend\models\SgdnPrContactoTpSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SgdnPrContactoTpController implements the CRUD actions for SgdnPrContactoTp model.
 */
class SgdnPrContactoTpController extends Controller
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
     * Lists all SgdnPrContactoTp models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SgdnPrContactoTpSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SgdnPrContactoTp model.
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
     * Creates a new SgdnPrContactoTp model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SgdnPrContactoTp();
        $codeauto = SgdnPrContactoTp::find()->orderBy(['CODIGO' => SORT_DESC])->one();
        if($codeauto==null){
           $resultado = 0;
        }else{
          $resultado =  $codeauto->CODIGO;
        }
        $registro = $resultado + 1;
        $model->CODIGO = str_pad($registro, 4 , '0', STR_PAD_LEFT);

        if ($model->load(Yii::$app->request->post())) {

          if ($model->save())
          {
              return $this->redirect(['index']);
          }else{
            print_r($model->errors);
          }
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SgdnPrContactoTp model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

      $model = $this->findModel($id);
      if ($model->load(Yii::$app->request->post())) {

          if ($model->save())
          {
              return $this->redirect(['index']);
          }else{
            print_r($model->errors);
          }

      }

      return $this->renderAjax('update', [
          'model' => $model,
      ]);
    }

    /**
     * Deletes an existing SgdnPrContactoTp model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
      $model = $this->findModel($id);
      $model->ESTADO = 'I';
      if ($model->save()) {
          return $this->redirect(['index']);
      }else{
            print_r("Some Error...");
      }
    }

    /**
     * Finds the SgdnPrContactoTp model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SgdnPrContactoTp the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SgdnPrContactoTp::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
