<?php

namespace frontend\controllers;

use Yii;
use common\models\sgdnPessoa;
use common\models\SgdnRelContactos;
use common\models\SgdnRelDocumentos;
use common\models\sgdnPessoaSearch;
use common\models\SgdnRelUserPessoa;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\SgdmInstrutor;
use common\models\User;
use app\models\Model;
use yii\web\UploadedFile;

/**
 * SgdnPessoaController implements the CRUD actions for sgdnPessoa model.
 */
class SgdnPessoaController extends Controller
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
     * devolve pessoa request ajax, instrutor.
     */
    public function actionGetPessoa($id)
    {
          $model = $this->findModel($id);
          echo $this->renderAjax('view_detalhes_pessoa', [
              'model' => $model,
              'show_buttonOrLabel'=>false,
          ],true);
    }
    public function actionGetPessoa1($id)
    {
          $model = SgdmInstrutor::findOne($id)->pESSOA;
          echo $this->renderAjax('view_detalhes_pessoa', [
              'model' => $model,
              'show_buttonOrLabel'=>false,
          ],true);
    }

    /**
    * recebe pedido para fazer download ficheiro do formulário
    **/
    public function actionSampleDownload($filename)
    {
        ob_clean();
        \Yii::$app->response->sendFile($filename)->send();
    }

    public function actionSampleDisplay($filename)
    {
         ob_clean();
         $filePath = '/web/doc/pessoas/';
         $filename = explode("/", $filename);

        // Might need to change '@app' for another alias
        $completePath = Yii::getAlias('@app'.$filePath.'/'.$filename[2]);
        Yii::$app->response->sendFile( $completePath,$filename[2],['inline'=>true]);
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
     * Displays a single sgdnPessoa model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
          $model = $this->findModel($id);
          $modelContatos = SgdnRelContactos::find()->where(['PESSOA_ID' => $model->ID])->all();
          $modelDocumentos = SgdnRelDocumentos::find()->where(['PESSOA_ID' => $model->ID])->all();
          return $this->render('view', [
                'model' => $model,
                'modelContatos' => $modelContatos,
                'modelDocumentos' => $modelDocumentos,
          ]);
    }

    public function actionIndex()
    {
        $this->layout = "main_services";
        return $this->render('index');
    }

    /**
     * Creates a new sgdnPessoa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = "main_services";

        $model = new sgdnPessoa();
        $modelsSgdnRelContactos = [new SgdnRelContactos];
        $modelsSgdnRelDocumentos = [new SgdnRelDocumentos];

        $model->URL_FOTO = Yii::$app->user->identity->url_perfil;

        if ($model ->load(Yii::$app->request->post())) {

            $modelsSgdnContacto = Model::createMultiple(SgdnRelContactos::classname());
            Model::loadMultiple($modelsSgdnContacto, Yii::$app->request->post());

            $file = UploadedFile::getInstance($model, 'file');
              if($file){
                  $generateRandomName = Yii::$app->security->generateRandomString(). '.' .$file->extension;
                  $model->URL_FOTO = 'img/pessoas/'.$generateRandomName;
                  $file->saveAs('img/pessoas/'.$generateRandomName);
              }

              $modelsSgdnRelDocumento = Model::createMultiple(SgdnRelDocumentos::classname());
              Model::loadMultiple($modelsSgdnRelDocumento, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = SgdnRelContactos::validateMultiple($modelsSgdnContacto) && $valid;
            $valid = SgdnRelDocumentos::validateMultiple($modelsSgdnRelDocumento) && $valid;

            // $valid =  && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsSgdnContacto as $modelSgdnContacto) {
                            $modelSgdnContacto->PESSOA_ID = $model->ID;
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

                        $modelRelUserPessoa = new SgdnRelUserPessoa;
                        $modelRelUserPessoa->USER_ID = Yii::$app->user->identity->id;
                        $modelRelUserPessoa->PESSOA_ID = $model->ID;
                        if (! ($flag = $modelRelUserPessoa->save(false))) {
                          print_r($modelRelUserPessoa->errors);
                            $transaction->rollBack();
                            \Yii::$app->end();
                        }
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
     * Updates an existing sgdnPessoa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //$model->DT_NASC = date("d-m-Y",strtotime($model->DT_NASC));
        $modelContatos = $model->sgdnRelContactos;
        $modelDocumentos = $model->sgdnRelDocumentos;


        if ($model->load(Yii::$app->request->post()) ) {

                $oldIDs = ArrayHelper::map($modelContatos, 'ID', 'ID');
                $modelContatos = Model::createMultiple(SgdnRelContactos::classname(), $modelContatos);
                Model::loadMultiple($modelContatos, Yii::$app->request->post());
                $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelContatos, 'ID', 'ID')));

                $file = UploadedFile::getInstance($model, 'file');
                if($file){
                      $tmp = explode(".", $model->file);
                      $ext = end($tmp);
                      $generateRandomName = Yii::$app->security->generateRandomString().".{$ext}";
                      $dir = $file->saveAs('img/pessoas/'.$generateRandomName);
                      $model->file = $generateRandomName;
                      $model->URL_FOTO = 'img/pessoas/'.$generateRandomName;
                }

              $oldIDs = ArrayHelper::map($modelDocumentos, 'ID', 'ID');
              $modelDocumentos = Model::createMultiple(SgdnRelDocumentos::classname(), $modelDocumentos);
              Model::loadMultiple($modelDocumentos, Yii::$app->request->post());
              $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelDocumentos, 'ID', 'ID')));

               // validate all models
               $valid = $model->validate();
               $valid = Model::validateMultiple($modelContatos) && $valid && SgdnRelDocumentos::validateMultiple($modelDocumentos);

               if ($valid) {
                   $transaction = \Yii::$app->db->beginTransaction();

                   try {
                       if ($flag = $model->save(false)) {
                           foreach ($modelContatos as $modelSgdnContacto) {
                               $modelSgdnContacto->PESSOA_ID = $model->ID;
                               if (! ($flag = $modelSgdnContacto->save(false))) {
                                  print_r($modelSgdnContacto->errors);
                                   $transaction->rollBack();
                                   \Yii::$app->end();
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
                           return $this->redirect(['index']);
                       }
                   } catch (Exception $e) {
                       $transaction->rollBack();
                   }
               }

        }

        return $this->render('update', [
            'model' => $model,
            'modelContatos' => (empty($modelContatos)) ? [new SgdnRelContactos] : $modelContatos,
            'modelDocumentos' => (empty($modelDocumentos)) ? [new sgdnRelDocumentos] : $modelDocumentos,
        ]);
    }

    /**
     * Deletes an existing sgdnPessoa model.
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
     * Finds the sgdnPessoa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return sgdnPessoa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = sgdnPessoa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    // protected function findModel($id)
    // {
    //     if (($model = sgdnPessoa::findOne($id)) !== null) {
    //         return $model;
    //     }
    //
    //     throw new NotFoundHttpException('The requested page does not exist.');
    // }
}
