<?php

namespace backend\controllers;

use Yii;
use backend\models\SgdmInstrutor;
use backend\models\SgdmInstrutorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SgdmInstrutorController implements the CRUD actions for SgdmInstrutor model.
 */
class SgdmInstrutorController extends Controller
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

    public function actionGetPessoa($id)
    {
          $model = $this->findModel($id);
          echo $this->renderAjax('view_detalhes_pessoa', [
              'model' => $model,
              'show_buttonOrLabel'=>false,
          ],true);
    }

    /**
     * Lists all SgdmInstrutor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SgdmInstrutorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SgdmInstrutor model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
            'modelAux' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SgdmInstrutor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SgdmInstrutor();
        $codeauto = SgdmInstrutor::find()->orderBy(['CODIGO' => SORT_DESC])->one();
        if($codeauto==null){
           $resultado = 0;
        }else{
          $resultado =  $codeauto->CODIGO;
        }
        $registro = $resultado + 1;
        $model->CODIGO = str_pad($registro, 4 , '0', STR_PAD_LEFT);

        if($model->load(Yii::$app->request->post())) {

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
     * Updates an existing SgdmInstrutor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {

            // $flag = $model->update(FALSE);
            if($model->validate()){
                $model->save(false,['OBS']);
                return $this->redirect(['index']);
            }else {
                print_r($model->errors);
            }

        }else {
          // code...
          return $this->renderAjax('update', [
              'model' => $model,
          ]);
        }


    }

    /**
     * Deletes an existing SgdmInstrutor model.
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
     * Finds the SgdmInstrutor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SgdmInstrutor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SgdmInstrutor::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
