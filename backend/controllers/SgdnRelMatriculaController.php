<?php

namespace backend\controllers;

use Yii;
use backend\models\SgdnRelMatricula;
use backend\models\SgdnRelMatriculaSearch;
use backend\models\SgdnRelAula;
use backend\models\SgdnPessoa;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SgdnRelMatriculaController implements the CRUD actions for SgdnRelMatricula model.
 */
class SgdnRelMatriculaController extends Controller
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
     * Lists all SgdnRelMatricula models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SgdnRelMatriculaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SgdnRelMatricula model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
      $model = $this->findModel($id);
      // // $instructorCounter = SgdnRelAulaInstrutorModalidade::find()->where(['AULA_ID' => $model->ID])->count();
      // $modelAluno = SgdnPessoa::find()->where(['ID' => $model->ALUNO_ID])->one();
      return $this->renderAjax('view', [
          'model' => $model,
           // 'instructorCounter' => $instructorCounter,
           // 'modelAluno' => $modelAluno,
      ]);
    }

    /**
     * Creates a new SgdnRelMatricula model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

     public function actionGetAulaPrice($id){

           $model = SgdnRelAula::find()->where(['ID' => $id])->one();
           echo $model->PRECO;

     }

    public function actionCreate()
    {
        $model = new SgdnRelMatricula();

        $codeauto = SgdnRelMatricula::find()->orderBy(['CODIGO' => SORT_DESC])->one();
        if($codeauto==null){
           $resultado = 0;
        }else{
          $resultado =  $codeauto->CODIGO;
        }
        $registro = $resultado + 1;
        $model->CODIGO = str_pad($registro, 4 , '0', STR_PAD_LEFT);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model_aula = SgdnRelAula::find()->where(['ID' => $model->AULA_ID])->one();

            $model->PRECO = $model_aula->PRECO;

            if($model->save())
              return $this->redirect(['index']);
        }

        return $this->renderAjax('create', [
            'model' => $model,
            // 'modelsAula' => $modelAula,
        ]);
    }

    /**
     * Updates an existing SgdnRelMatricula model.
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

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SgdnRelMatricula model.
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

    public function actionRecover($id)
    {
        $model = $this->findModel($id);
        $model->ESTADO = 'A';
        if($model->save()){
            return $this->redirect(['index']);
        }else{
          print_r('Some Errors!');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the SgdnRelMatricula model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SgdnRelMatricula the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SgdnRelMatricula::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
