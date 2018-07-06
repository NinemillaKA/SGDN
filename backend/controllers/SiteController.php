<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\SgdnRelPerfil;
use backend\models\SgdnRelAulaInstrutorModalidade;
use backend\models\SgdmInstrutor;
use backend\models\SgdnRelMatricula;
use backend\models\SgdnRelAula;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','geteventoscalendar'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','geteventoscalendar'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


    /**
    *
    */
    public function actionGeteventoscalendar()
    {
      $x = SgdnRelAula::find()->where(['ESTADO'=>'A'])->all();
      print_r($x);

      $evento =   [
        'title'         => 'All Day Event',
        'start'          => \Date("Y-m-d"),
        'backgroundColor'=> '#f56954',
        'borderColor'    => '#f56954'
      ];
      return json_encode($evento);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

      $user_type = SgdnRelPerfil::find()->select(['DESIG'])->where('ID=:id', [ ':id' => Yii::$app->user->identity->sgdn_rel_perfil_ID ])->One();
      // var_dump($user_type);
      // Yii::$app->end();
      if ($user_type['DESIG'] == 'Administrador') {
        // code...
        return $this->render('index_dash_admin');
      }elseif ($user_type['DESIG'] == 'Gestor Escola') {

        $instrutores = SgdmInstrutor::find()->all();
        $instructorCounter = SgdnRelAulaInstrutorModalidade::find()->select('INSTRUTOR_MODALIDADE_ID')->distinct()->count();

        $alunos = SgdnRelMatricula::find()->all();
        $alunosCounter = SgdnRelMatricula::find()->select('ALUNO_ID')->distinct()->count();


        return $this->render('index_dash_gestor', [
             'instructorCounter' => $instructorCounter,
             'instrutores' => $instrutores,
             'alunos' => $alunos,
             'alunosCounter' => $alunosCounter
        ]);

        return $this->render('index_dash_gestor');
      }else {
        return $this->render('index');
      }


    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
