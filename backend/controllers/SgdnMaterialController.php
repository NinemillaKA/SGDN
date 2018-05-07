<?php

namespace backend\controllers;

use Yii;
use backend\models\SgdnMaterial;
use backend\models\SgdnMaterialSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Model;
use yii\web\UploadedFile;

/**
 * SgdnMaterialController implements the CRUD actions for SgdnMaterial model.
 */
class SgdnMaterialController extends Controller
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
     * Lists all SgdnMaterial models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SgdnMaterialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SgdnMaterial model.
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
     * Creates a new SgdnMaterial model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SgdnMaterial();
        $codeauto = SgdnMaterial::find()->orderBy(['CODIGO' => SORT_DESC])->one();
        if($codeauto==null){
           $resultado = 0;
        }else{
          $resultado =  $codeauto->CODIGO;
        }
        $registro = $resultado + 1;
        $model->CODIGO = str_pad($registro, 4 , '0', STR_PAD_LEFT);

        $file = UploadedFile::getInstance($model, 'file');
        if($file){
            $generateRandomName = Yii::$app->security->generateRandomString(). '.' .$file->extension;
            $model->URL_LOGO = 'img/materiais/'.$generateRandomName;
            $file->saveAs('img/materiais/'.$generateRandomName);
        }

        if ($model->load(Yii::$app->request->post())) {

                  if($model->save()){
                      return $this->redirect(['view', 'id' => $model->ID]);
                  }

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SgdnMaterial model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $file = UploadedFile::getInstance($model, 'file');
        if($file){
            $generateRandomName = Yii::$app->security->generateRandomString(). '.' .$file->extension;
            $model->URL_LOGO = 'img/materiais/'.$generateRandomName;
            $file->saveAs('img/materiais/'.$generateRandomName);
        }

        if ($model->load(Yii::$app->request->post()) ){

              if($model->save()){
                  return $this->redirect(['view', 'id' => $model->ID]);
              }

        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SgdnMaterial model.
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
     * Finds the SgdnMaterial model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SgdnMaterial the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SgdnMaterial::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
