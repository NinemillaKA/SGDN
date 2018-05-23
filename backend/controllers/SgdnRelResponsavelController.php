<?php

namespace backend\controllers;

use Yii;
use backend\models\SgdnRelResponsavel;
use backend\models\SgdnRelResponsavelSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SgdnRelResponsavelController implements the CRUD actions for SgdnRelResponsavel model.
 */
class SgdnRelResponsavelController extends Controller
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
     * Lists all SgdnRelResponsavel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SgdnRelResponsavelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SgdnRelResponsavel model.
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
     * Creates a new SgdnRelResponsavel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SgdnRelResponsavel();

        if ($model->load(Yii::$app->request->post())) {

            // $model->DT_INICIO = explode(' ', $model->DT_INICIO);
            // $model->DT_INICIO = $model->DT_INICIO[0];
            //
            // $model->DT_FIM = explode(' ', $model->DT_FIM);
            // $model->DT_FIM = $model->DT_FIM[0];

            if($model->save())
                return $this->redirect(['index']);
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SgdnRelResponsavel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            if($model->save())
                return $this->redirect(['index']);
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SgdnRelResponsavel model.
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
     * Finds the SgdnRelResponsavel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SgdnRelResponsavel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SgdnRelResponsavel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
