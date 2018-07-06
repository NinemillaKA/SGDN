<?php

namespace frontend\controllers;

use Yii;
use common\models\SgdnRelMatricula;
use common\models\SgdnRelMatriculaSearch;
use common\models\SgdnRelAula;
use common\models\SgdnPessoa;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SgdnRelMatriculaController implements the CRUD actions for SgdnRelMatricula model.
 */
class SgdnRelMatriculaController extends Controller
{
   public $layout = "main_services";
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

        $aulas = (new \yii\db\Query())
             ->select('*')
             ->from('sgdn_rel_aula')
             ->where([
                'ESTADO' => 'A'
             ])
             ->orderBy([
                 'DT_REGISTO' => SORT_ASC
             ])
             ->all();

         return $this->render('index', [
           'aulas'=>$aulas
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

    public function actionCreate($id)
    {
        $model = new SgdnRelMatricula();
        $model->AULA_ID = $id;
        $model_aula = SgdnRelAula::find()->where(['ID' => $model->AULA_ID])->one();

        $codeauto = SgdnRelMatricula::find()->orderBy(['CODIGO' => SORT_DESC])->one();
        if($codeauto==null){
           $resultado = 0;
        }else{
          $resultado =  $codeauto->CODIGO;
        }
        $registro = $resultado + 1;
        $model->CODIGO = str_pad($registro, 4 , '0', STR_PAD_LEFT);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {


            $model->PRECO = $model_aula->PRECO;

            if($model->save())
              return $this->redirect(['index']);
        }

        return $this->renderAjax('create', [
            'model' => $model,
            'model_aula' => $model_aula,
        ]);
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
