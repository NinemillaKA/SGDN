<?php

namespace backend\controllers;

use Yii;
use backend\models\SgdnViagen;
use backend\models\SgdnViagenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * SgdnViagenController implements the CRUD actions for SgdnViagen model.
 */
class SgdnViagenController extends Controller
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
     * Lists all SgdnViagen models.
     * @return mixed
     */

    public function actionGetViagen($id)
    {
        $model = $this->findModel($id);

        echo $this->render('view_detalhes_viagen', [
            'model' => $model,
            'show_buttonOrLabel'=>false,
        ],true);

    }
    public function actionIndex()
    {
        $searchModel = new SgdnViagenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SgdnViagen model.
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
     * Creates a new SgdnViagen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SgdnViagen();

        $codeauto = SgdnViagen::find()->orderBy(['CODIGO' => SORT_DESC])->one();
        if($codeauto==null){
           $resultado = 0;
        }else{
          $resultado =  $codeauto->CODIGO;
        }
        $registro = $resultado + 1;
        $model->CODIGO = str_pad($registro, 4 , '0', STR_PAD_LEFT); //


        // var_dump($model);
        // Yii::$app->end();
        //
        if ($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'file');
              if($file){
                  $generateRandomName = Yii::$app->security->generateRandomString(). '.' .$file->extension;
                  $model->URL_IMAGEM = 'img/viagens/'.$generateRandomName;
                  $file->saveAs('img/viagens/'.$generateRandomName);
              }
              // $model = Yii::$app->request->post();
              $address = $_POST['SgdnViagen']['address'];
              $latitude = $_POST['SgdnViagen']['latitude'];
              $longitude = $_POST['SgdnViagen']['longitude'];

              $address2 = $_POST['SgdnViagen']['address2'];
              $latitude2 = $_POST['SgdnViagen']['latitude2'];
              $longitude2 = $_POST['SgdnViagen']['longitude2'];

              $model->CORD_ORIGIN = $address.'_'.$latitude.'_'.$longitude;
              $model->CORD_DESTINY = $address2.'_'.$latitude2.'_'.$longitude2;
              // var_dump($model->CORD_ORIGIN.'_'.$model->CORD_DESTINY);
              // Yii::$app->end();
              if($model->save())
              {
                  return $this->redirect(['index']);
              }else{
                print_r($model->errors);
              }

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    /**
     * Updates an existing SgdnViagen model.
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
                $dir = $file->saveAs('img/viagens/'.$generateRandomName);
                $model->file = $generateRandomName;
                $model->URL_IMAGEM = 'img/viagens/'.$generateRandomName;
           }
            if($model->save())
                return $this->redirect(['index']);
            else
                  print_r($model->errors);
        }

        return $this->render('update', [
            'model' => $model,
        ]);

    }

    /**
     * Deletes an existing SgdnViagen model.
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
     * Finds the SgdnViagen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SgdnViagen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SgdnViagen::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
