<?php

namespace backend\controllers;

use Yii;
use backend\models\SgdnRelAula;
use backend\models\SgdnRelAulaSearch;
use backend\models\SgdnRelAulaInstrutorModalidade;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\Model;
use backend\models\SgdnRelInstrutorModalidade;



/**
 * SgdnRelAulaController implements the CRUD actions for SgdnRelAula model.
 */
class SgdnRelAulaController extends Controller
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


    // init CALENDAR

    public function actionCalendar(){

        return $this->render('calendar');
    }

    public function actionLists($id)
    {

         $countPosts = SgdnRelInstrutorModalidade::find()
         ->where(['PR_MODALIDADE_ID' => $id])
         ->count();

         $models = SgdnRelInstrutorModalidade::find()
         ->where(['PR_MODALIDADE_ID' => $id])
         ->all();

         if($countPosts>0){
           foreach($models as $model){

              echo "<option value=\"".$model->ID."\">".$model->iNSTRUTOR->pESSOA->NOME."</option>";
           }
         }
         else{
         echo "<option>-</option>";
         }

     }

    /**
     * Lists all SgdnRelAula models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SgdnRelAulaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SgdnRelAula model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
     // public function getComment_count()
     // {
     //     return SgdnRelAulaInstrutorModalidade::find()->where(['AULA_ID' => $this->id])->count();
     // }
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $instructorCounter = SgdnRelAulaInstrutorModalidade::find()->where(['AULA_ID' => $model->ID])->count();
        $modelsSgdnRelAulaInstrutorModalidade = SgdnRelAulaInstrutorModalidade::find()->where(['AULA_ID' => $model->ID])->all();
        return $this->renderAjax('view', [
            'model' => $model,
             'instructorCounter' => $instructorCounter,
             'modelAulaInstrutorModalidade' => $modelsSgdnRelAulaInstrutorModalidade,
        ]);
    }

    /**
     * Creates a new SgdnRelAula model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate()
    {
        $model = new SgdnRelAula();

        $codeauto = SgdnRelAula::find()->orderBy(['CODIGO' => SORT_DESC])->one();
        if($codeauto==null){
           $resultado = 0;
        }else{
          $resultado =  $codeauto->CODIGO;
        }
        $registro = $resultado + 1;
        $model->CODIGO = str_pad($registro, 4 , '0', STR_PAD_LEFT);

        $modelsSgdnRelAulaInstrutorModalidade = [new SgdnRelAulaInstrutorModalidade];

        if ($model->load(Yii::$app->request->post())) {

            $modelsSgdnRelAulaInstrutorModalidade = Model::createMultiple(SgdnRelAulaInstrutorModalidade::classname());
            Model::loadMultiple($modelsSgdnRelAulaInstrutorModalidade, Yii::$app->request->post());

            $model->DT_INICIO = explode(' ', $model->DT_INICIO);
            $model->HORA_INICIO = $model->DT_INICIO[1];
            $model->DT_INICIO = $model->DT_INICIO[0];

            $model->DT_FIM = explode(' ', $model->DT_FIM);
            $model->HORA_FIM = $model->DT_FIM[1];
            $model->DT_FIM = $model->DT_FIM[0];


            $valid = $model->validate();
            $valid = SgdnRelAulaInstrutorModalidade::validateMultiple($modelsSgdnRelAulaInstrutorModalidade) && $valid;
            //var_dump($valid);
            if ($valid)

                $transaction = \Yii::$app->db->beginTransaction();
                try {

                      if ($flag = $model->save(false)) {
                          foreach ($modelsSgdnRelAulaInstrutorModalidade as $modelSgdnAulaInstrutorModalidade) {

                              $modelSgdnAulaInstrutorModalidade->AULA_ID = $model->ID;
                              $modelSgdnAulaInstrutorModalidade->INSTRUTOR_MODALIDADE_ID = $modelSgdnAulaInstrutorModalidade->INSTRUTOR_MODALIDADE_ID;
                              if (! ($flag = $modelSgdnAulaInstrutorModalidade->save(false))) {
                                 print_r($modelSgdnAulaInstrutorModalidade->errors);
                                  $transaction->rollBack();
                                    echo "5";
                                  \Yii::$app->end();
                                  break;
                              }

                          }
                      }else{
                          echo "1";
                          print_r ($model->errors);
                          \Yii::$app->end();
                      }
                } catch (Exception $e) {
                      echo "2";
                    $transaction->rollBack();
                }

                if($flag){
                    $transaction->commit();
                    echo "3";
                    return $this->redirect(['index']);
                }else{
                    echo "4";
                    print_r ($model->errors);
                }
           }
        // }

        return $this->renderAjax('create', [
            'model' => $model,
            'modelAulaInstrutorModalidade' => $modelsSgdnRelAulaInstrutorModalidade,
        ]);
    }

    /**
     * Updates an existing SgdnRelAula model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelsSgdnRelAulaInstrutorModalidade = $model->sgdnRelAulaInstrutorModalidades;

        if ($model->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsSgdnRelAulaInstrutorModalidade, 'ID', 'ID');
            $modelsSgdnRelAulaInstrutorModalidade = Model::createMultiple(SgdnRelAulaInstrutorModalidade::classname(), $modelsSgdnRelAulaInstrutorModalidade);
            Model::loadMultiple($modelsSgdnRelAulaInstrutorModalidade, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsSgdnRelAulaInstrutorModalidade, 'ID', 'ID')));

            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsSgdnRelAulaInstrutorModalidade);

            if ($valid)
            {
              $transaction = \Yii::$app->db->beginTransaction();
              try {
                    if ($flag = $model->save(false)) {
                            if (!empty($deletedIDs)) {
                                SgdnRelAulaInstrutorModalidade::deleteAll(['ID' => $deletedIDs]);
                            }
                            foreach ($modelsSgdnRelAulaInstrutorModalidade as $modelSgdnRelAulaInstrutorModalidade) {
                                $modelSgdnRelAulaInstrutorModalidade->AULA_ID = $model->ID;
                                if (! ($flag = $modelSgdnRelAulaInstrutorModalidade->save(false))) {
                                    $transaction->rollBack();
                                    break;
                                }
                            }
                            return $this->redirect(['index']);
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
            'modelAulaInstrutorModalidade' => (empty($modelsSgdnRelAulaInstrutorModalidade)) ? [new SgdnRelAulaInstrutorModalidade] : $modelsSgdnRelAulaInstrutorModalidade,

        ]);

    }

    /**
     * Deletes an existing SgdnRelAula model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
          $model = $this->findModel($id);

          ($model->ESTADO == 'A') ? $model->ESTADO = 'I' : $model->ESTADO = 'A';

          if ($model->save()) {
              return $this->redirect(['index']);
          }else{
                print_r("Some Error...");
          }

    }

    /**
     * Finds the SgdnRelAula model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SgdnRelAula the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SgdnRelAula::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
