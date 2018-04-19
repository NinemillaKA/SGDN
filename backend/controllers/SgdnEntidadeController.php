<?php

namespace backend\controllers;

use Yii;
use backend\models\GlbGeografia;
use backend\models\SgdnEntidade;
use backend\models\SgdnRelContactos;
use backend\models\SgdnRelDocumentos;
use backend\models\SgdnEntidadeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Model;
use yii\web\UploadedFile;





/**
 * SgdnEntidadeController implements the CRUD actions for SgdnEntidade model.
 */
class SgdnEntidadeController extends Controller
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

    /*
    * devolve conselho por id de ilha tabela geografia ajax
    */

    /*
    * dawnload request
    */
    public function actionSampleDownload($filename)
    {
        ob_clean();
        \Yii::$app->response->sendFile($filename)->send();
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
     * Lists all SgdnEntidade models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SgdnEntidadeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SgdnEntidade model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
      $model = $this->findModel($id);
      $modelContatos = SgdnRelContactos::find()->where(['ENTIDADE_ID' => $model->ID])->all();
      $modelDocumentos = SgdnRelDocumentos::find()->where(['ENTIDADE_ID' => $model->ID])->all();
        return $this->render('view', [
            'model' => $model,
            'modelContatos' =>$modelContatos,
            'modelDocumentos' =>$modelDocumentos,
        ]);
    }

    /**
     * Creates a new SgdnEntidade model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
      //code generate
        $model = new SgdnEntidade();
        $codeauto = SgdnEntidade::find()->orderBy(['CODIGO' => SORT_DESC])->one();
        if($codeauto==null){
           $resultado = 0;
        }else{
          $resultado =  $codeauto->CODIGO;
        }
        $registro = $resultado + 1;
        $model->CODIGO = str_pad($registro, 4 , '0', STR_PAD_LEFT); //

        $modelsSgdnRelContactos = [new SgdnRelContactos];
        $modelsSgdnRelDocumentos = [new SgdnRelDocumentos];

        if ($model ->load(Yii::$app->request->post())) {

            $modelsSgdnContacto = Model::createMultiple(SgdnRelContactos::classname());
            Model::loadMultiple($modelsSgdnContacto, Yii::$app->request->post());

            $file = UploadedFile::getInstance($model, 'file');
              if($file){
                 $generateRandomName = Yii::$app->security->generateRandomString(). '.' .$file->extension;
                  $model->URL_LOGO = 'img/entidades/'.$generateRandomName;
                  $file->saveAs('img/entidades/'.$generateRandomName);
              }

              $modelsSgdnRelDocumento = Model::createMultiple(SgdnRelDocumentos::classname());
              Model::loadMultiple($modelsSgdnRelDocumento, Yii::$app->request->post());

              // validate all models
              $valid = $model->validate();
              $valid = SgdnRelContactos::validateMultiple($modelsSgdnContacto) && $valid;
              $valid = SgdnRelDocumentos::validateMultiple($modelsSgdnRelDocumento) && $valid;

              /*
              * Validação dos modelos( contactos && documentos)
              */
              if ($valid) {
                  $transaction = \Yii::$app->db->beginTransaction();

                  try {
                      if ($flag = $model->save(false)) {
                          foreach ($modelsSgdnContacto as $modelSgdnContacto) {
                              $modelSgdnContacto->ENTIDADE_ID = $model->ID;
                              if (! ($flag = $modelSgdnContacto->save(false))) {
                                 print_r($modelSgdnContacto->errors);
                                  $transaction->rollBack();
                                  \Yii::$app->end();
                                  break;
                              }
                           }
                          //echo "fim contacto";\Yii::$app->end();
                          foreach ($modelsSgdnRelDocumento as $i => $modelSgdnDocumento) {
                            $docfile = UploadedFile::getInstance($modelSgdnDocumento, "[$i]docfile");
                              if($docfile){
                                  $generateRandomName = Yii::$app->security->generateRandomString(). '.' .$docfile->extension;
                                  $modelSgdnDocumento->URL_DOCUMENTO = 'doc/entidades/'.$generateRandomName;
                                  $docfile->saveAs('doc/entidades/'.$generateRandomName);
                                  echo "doc_upload_success";
                                  // doc file don't save in his DI

                              }

                              $modelSgdnDocumento->ENTIDADE_ID = $model->ID;
                              if (! ($flag = $modelSgdnDocumento->save(false))) {
                                print_r($modelSgdnDocumento->errors);
                                  $transaction->rollBack();
                                  \Yii::$app->end();
                                  break;
                              }
                          }
                        //  echo "fim doc";\Yii::$app->end(); debug

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
              //print_r($model->errors);
              //print_r(SgdnRelContactos::validateMultiple($modelsSgdnContacto)->errors);
              //echo "fim";\Yii::$app->end();
          }

          return $this->render('create', [
              'model' => $model,
              'modelContatos' => $modelsSgdnRelContactos,
              'modelDocumentos' => $modelsSgdnRelDocumentos,
          ]);

    }
    /**
     * Updates an existing SgdnEntidade model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        $modelContatos = $model->sgdnRelContactos;
        $modelDocumentos = $model->sgdnRelDocumentos;

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
                     $dir = $file->saveAs('img/entidades/'.$generateRandomName);
                     $model->file = $generateRandomName;
                     $model->URL_FOTO = 'img/entidades/'.$generateRandomName;
              }

              $oldIDs = ArrayHelper::map($modelDocumentos, 'ID', 'ID');
              $modelDocumentos = Model::createMultiple(SgdnRelDocumentos::classname(), $modelDocumentos);
              Model::loadMultiple($modelDocumentos, Yii::$app->request->post());
              $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelDocumentos, 'ID', 'ID')));

               // validate all models
               $valid = $model->validate();
               $valid = Model::validateMultiple($modelContatos) && $valid && SgdnRelDocumentos::validateMultiple($modelDocumentos);

               if ($valid){
                   $transaction = \Yii::$app->db->beginTransaction();
                   try {
                         if ($flag = $model->save(false)) {
                                 if (!empty($deletedIDs)) {
                                     SgdnRelContactos::deleteAll(['ID' => $deletedIDs]);
                                 }
                                 foreach ($modelContatos as $modelContatos) {
                                     $modelContatos->ENTIDADE_ID = $model->ID;
                                     if (! ($flag = $modelContatos->save(false))) {
                                         $transaction->rollBack();
                                         break;
                                     }
                                 }
                                 //echo "fim contacto";\Yii::$app->end();
                                 foreach ($modelDocumentos as  $i => $modelSgdnDocumento) {
                                     $docfile = UploadedFile::getInstance($modelSgdnDocumento, "[$i]docfile");
                                     if($docfile){
                                         $generateRandomName = Yii::$app->security->generateRandomString(). '.' .$docfile->extension;
                                         $modelSgdnDocumento->URL_DOCUMENTO = 'doc/pessoas/'.$generateRandomName;
                                         $docfile->saveAs('doc/pessoas/'.$generateRandomName);
                                         echo "doc_upload_success";
                                         // doc file don't save in his DI
                                     }

                                     $modelSgdnDocumento->PESSOA_ID = $model->ID;
                                     if (! ($flag = $modelSgdnDocumento->save(false))) {
                                       print_r($modelSgdnDocumento->errors);
                                         $transaction->rollBack();
                                         \Yii::$app->end();
                                         break;
                                     }
                                  }
                                // echo "fim doc";\Yii::$app->end();
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

        return $this->render('update', [
            'model' => $model,
            'modelContatos' => (empty($modelContatos)) ? [new SgdnRelContactos] : $modelContatos,
            'modelDocumentos' => (empty($modelDocumentos)) ? [new sgdnRelDocumentos] : $modelDocumentos,
        ]);
    }

    /**
     * Deletes an existing SgdnEntidade model.
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
     * Finds the SgdnEntidade model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SgdnEntidade the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SgdnEntidade::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
