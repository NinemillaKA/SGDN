<?php

namespace backend\controllers;

use Yii;
use backend\models\SgdnResidencia;
use backend\models\SgdnResidenciaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use backend\models\SgdnRelContactos;
use app\models\Model;
use yii\web\UploadedFile;
/**
 * SgdnResidenciaController implements the CRUD actions for SgdnResidencia model.
 */
class SgdnResidenciaController extends Controller
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

    public function actionGetResidencia($id)
    {
          $model = $this->findModel($id);
          echo $this->renderAjax('view_detalhes_residencia', [
              'model' => $model,
              'show_buttonOrLabel'=>false,
          ],true);
    }

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


    /**
     * Lists all SgdnResidencia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SgdnResidenciaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SgdnResidencia model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $modelContatos = SgdnRelContactos::find()->where(['REL_RESIDENCIA_ID' => $model->ID])->all();
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
            'modelContatos' =>$modelContatos,
        ]);
    }

    /**
     * Creates a new SgdnResidencia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SgdnResidencia();
        $modelsSgdnRelContactos = [new SgdnRelContactos];
        // var_dump($model);

        if ($model->load(Yii::$app->request->post())) {

            $modelsSgdnContacto = Model::createMultiple(SgdnRelContactos::classname());
            Model::loadMultiple($modelsSgdnContacto, Yii::$app->request->post());

            $file = UploadedFile::getInstance($model, 'file');
                if($file){
                   $generateRandomName = Yii::$app->security->generateRandomString(). '.' .$file->extension;
                    $model->URL_LOGO = 'img/residencias/'.$generateRandomName;
                    $file->saveAs('img/residencias/'.$generateRandomName);
                }
            // model validate
            $valid = $model->validate();
            $valid = SgdnRelContactos::validateMultiple($modelsSgdnContacto) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsSgdnContacto as $modelSgdnContacto) {
                            $modelSgdnContacto->REL_RESIDENCIA_ID = $model->ID;
                            if (! ($flag = $modelSgdnContacto->save(false))) {
                               print_r($modelSgdnContacto->errors);
                                $transaction->rollBack();
                                \Yii::$app->end();
                                break;
                            }
                         }
                        //echo "fim contacto";\Yii::$app->end();
                    }else{
                      print_r($model->errors);
                      \Yii::$app->end();
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->renderAjax('create', [
            'model' => $model,
            'modelContatos' => $modelsSgdnRelContactos,
        ]);

    }

    /**
     * Updates an existing SgdnResidencia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelContatos = $model->sgdnRelContactos;

        if ($model->load(Yii::$app->request->post())) {

               $oldIDs = ArrayHelper::map($modelContatos, 'ID', 'ID');
               $modelContatos = Model::createMultiple(SgdnRelContactos::classname(), $modelContatos);
               Model::loadMultiple($modelContatos, Yii::$app->request->post());
               $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelContatos, 'ID', 'ID')));

               $file = UploadedFile::getInstance($model, 'file');
               if($file){
                     $tmp = explode(".", $model->file);
                     $ext = end($tmp);
                     $generateRandomName = Yii::$app->security->generateRandomString().".{$ext}";
                     $dir = $file->saveAs('img/residencias/'.$generateRandomName);
                     $model->file = $generateRandomName;
                     $model->URL_LOGO = 'img/residencias/'.$generateRandomName;
              }

               // validate all models
               $valid = $model->validate();
               $valid = Model::validateMultiple($modelContatos) && $valid;

               if ($valid){
                   $transaction = \Yii::$app->db->beginTransaction();
                   try {
                         if ($flag = $model->save(false)) {
                                 if (!empty($deletedIDs)) {
                                     SgdnRelContactos::deleteAll(['ID' => $deletedIDs]);
                                 }
                                 foreach ($modelContatos as $modelContatos) {
                                     $modelContatos->REL_RESIDENCIA_ID = $model->ID;
                                     if (! ($flag = $modelContatos->save(false))) {
                                         $transaction->rollBack();
                                         break;
                                     }
                                 }
                                 //echo "fim contacto";\Yii::$app->end();
                           }else{
                                   print_r($model->errors);
                                   \Yii::$app->end();
                           }
                           if ($flag) {
                               $transaction->commit();
                               return $this->redirect(['view', 'id' => $model->ID]);
                           }
                       } catch (Exception $e) {
                           $transaction->rollBack();
                       }
                 }

                 return $this->redirect(['view', 'id' => $model->ID]);
        }

        return $this->renderAjax('update', [
            'model' => $model,
            'modelContatos' => (empty($modelContatos)) ? [new SgdnRelContactos] : $modelContatos,
        ]);
    }

    /**
     * Deletes an existing SgdnResidencia model.
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
     * Finds the SgdnResidencia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SgdnResidencia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SgdnResidencia::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
