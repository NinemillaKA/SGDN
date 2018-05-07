<?php

namespace backend\controllers;

use Yii;
use backend\models\GlbGeografia;
use backend\models\SgdnSpot;
use backend\models\SgdnSpotSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * SgdnSpotController implements the CRUD actions for SgdnSpot model.
 */
class SgdnSpotController extends Controller
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
     * Lists all SgdnSpot models.
     * @return mixed
     */

     public function actionDroplistConselho($id)
     {
       $rows = (new \yii\db\Query())
             ->select(['ID', 'NOME'])
             ->from('glb_geografia')
             ->where(['ILHA' => $id, 'NIVEL_DETALHE'=>'3'])
             ->all();

         echo '<option value="">*** Selecione Concelho ***</option>';

        foreach ($rows as $row) {
                echo '<option value="'.$row['ID'].'">'.$row['NOME'].'</option>';
        }
     }

     public function actionDroplistFreguesia($id)
     {
       $rows = (new \yii\db\Query())
             ->select(['ID', 'NOME'])
             ->from('glb_geografia')
             ->where(['CONCELHO' => $id, 'NIVEL_DETALHE'=>'4'])
             ->all();
          echo '<option value="">*** Selecione Freguesia ***</option>';

        foreach ($rows as $row) {
                echo '<option value="'.$row['ID'].'">'.$row['NOME'].'</option>';
        }
     }

     public function actionDroplistZona($id)
     {
       $rows = (new \yii\db\Query())
             ->select(['ID', 'NOME'])
             ->from('glb_geografia')
             ->where(['FREGUESIA' => $id, 'NIVEL_DETALHE'=>'5'])
             ->all();
       echo '<option value="">*** Selecione Zona ***</option>';

        foreach ($rows as $row) {
                echo '<option value="'.$row['ID'].'">'.$row['NOME'].'</option>';
        }
     }

  public function actionGetSpot($id){
      $model = $this->findModel($id);
      echo $this->renderAjax('view_detalhes_spot', [
          'model' => $model,
          'show_buttonOrLabel'=>false,
      ],true);
  }


    public function actionIndex()
    {
        $searchModel = new SgdnSpotSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SgdnSpot model.
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
     * Creates a new SgdnSpot model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SgdnSpot();
        $codeauto = SgdnSpot::find()->orderBy(['CODIGO' => SORT_DESC])->one();
        if($codeauto==null){
           $resultado = 0;
        }else{
          $resultado =  $codeauto->CODIGO;
        }
        $registro = $resultado + 1;
        $model->CODIGO = str_pad($registro, 4 , '0', STR_PAD_LEFT); //

        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'file');
              if($file){
                 $generateRandomName = Yii::$app->security->generateRandomString(). '.' .$file->extension;
                  $model->URL_IMAGEM = 'img/spots/'.$generateRandomName;
                  $file->saveAs('img/spots/'.$generateRandomName);
              }

              if ($model->save())
              {
                  return $this->redirect(['view', 'id' => $model->ID]);
              }else{
                print_r($model->errors);
              }

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SgdnSpot model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            $file = UploadedFile::getInstance($model, 'file');
            if($file){
                $tmp = explode(".", $model->file);
                $ext = end($tmp);
                $generateRandomName = Yii::$app->security->generateRandomString().".{$ext}";
                $dir = $file->saveAs('img/spots/'.$generateRandomName);
                $model->file = $generateRandomName;
                $model->URL_IMAGEM = 'img/spots/'.$generateRandomName;
           }
            if($model->save())
                return $this->redirect(['view', 'id' => $model->ID]);
            else
                  print_r($model->errors);

        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SgdnSpot model.
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
     * Finds the SgdnSpot model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SgdnSpot the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SgdnSpot::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
