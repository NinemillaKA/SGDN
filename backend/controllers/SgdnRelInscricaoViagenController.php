<?php

namespace backend\controllers;

use Yii;
use backend\models\SgdnRelInscricaoViagen;
use backend\models\SgdnRelInscricaoViagenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SgdnRelInscricaoViagenController implements the CRUD actions for SgdnRelInscricaoViagen model.
 */
class SgdnRelInscricaoViagenController extends Controller
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
     * Lists all SgdnRelInscricaoViagen models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SgdnRelInscricaoViagenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SgdnRelInscricaoViagen model.
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
     * Creates a new SgdnRelInscricaoViagen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SgdnRelInscricaoViagen();

        if ($model->load(Yii::$app->request->post())) {

          if ($model->save())
              return $this->redirect(['index']);

          else
              print_r ($model->errors);

        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SgdnRelInscricaoViagen model.
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
              return $this->redirect(['index']);

          else
              print_r ($model->errors);

        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SgdnRelInscricaoViagen model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->ESTADO = 'I';
        if($model->save()){
            return $this->redirect(['index']);
        }else{
          print_r('Some Errors!');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the SgdnRelInscricaoViagen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SgdnRelInscricaoViagen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SgdnRelInscricaoViagen::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
