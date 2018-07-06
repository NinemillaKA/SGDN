<?php

namespace commom\controllers;

use Yii;
use commom\models\SgdnRelAlojamento;
use commom\models\SgdnRelAlojamentoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use commom\models\SgdnResidencia;

/**
 * SgdnRelAlojamentoController implements the CRUD actions for SgdnRelAlojamento model.
 */
class SgdnRelAlojamentoController extends Controller
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

    public function actionGetPriceCalculator($id,$dtini,$dtfim)
    {
        $id = $_GET['id'];
        $datetime1 = $_GET['dtini'];
        $datetime2 = $_GET['dtfim'];

        $datetime1 = new \DateTime($datetime1);
        $datetime2 = new \DateTime($datetime2);

        $interval = $datetime2->diff($datetime1)->format("%a");

        $model = SgdnResidencia::find()->where(['ID' => $id])->one();
        $price  = $model->PRECO_DIA * $interval ;

        echo $price;
    }

    /**
     * Lists all SgdnRelAlojamento models.
     * @return mixed
     */
    // public function actionIndex()
    // {
    //     $searchModel = new SgdnRelAlojamentoSearch();
    //     $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    //
    //     return $this->render('index', [
    //         'searchModel' => $searchModel,
    //         'dataProvider' => $dataProvider,
    //     ]);
    // }

    /**
     * Displays a single SgdnRelAlojamento model.
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
     * Creates a new SgdnRelAlojamento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SgdnRelAlojamento();
        // var_dump($model);
        if ($model->load(Yii::$app->request->post())) {

              if($model->save())
                  return $this->redirect(['index']);
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    // /**
    //  * Updates an existing SgdnRelAlojamento model.
    //  * If update is successful, the browser will be redirected to the 'view' page.
    //  * @param string $id
    //  * @return mixed
    //  * @throws NotFoundHttpException if the model cannot be found
    //  */
    // public function actionUpdate($id)
    // {
    //     $model = $this->findModel($id);
    //
    //     if ($model->load(Yii::$app->request->post())) {
    //
    //         if($model->save())
    //             return $this->redirect(['index']);
    //     }
    //
    //     return $this->renderAjax('update', [
    //         'model' => $model,
    //     ]);
    // }
    //
    // /**
    //  * Deletes an existing SgdnRelAlojamento model.
    //  * If deletion is successful, the browser will be redirected to the 'index' page.
    //  * @param string $id
    //  * @return mixed
    //  * @throws NotFoundHttpException if the model cannot be found
    //  */
    // public function actionDelete($id)
    // {
    //     $model = $this->findModel($id);
    //     $model->ESTADO = 'I';
    //     if($model->save()){
    //         return $this->redirect(['index']);
    //     }else{
    //       print_r('Some Errors!');
    //     }
    //
    //     return $this->redirect(['index']);
    // }

    /**
     * Finds the SgdnRelAlojamento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SgdnRelAlojamento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SgdnRelAlojamento::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
