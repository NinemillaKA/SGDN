<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\SgdnRelUserPessoa;
use common\models\SgdnRelAlojamento;
use common\models\SgdnRelMatricula;
use common\models\SgdnRelAluguer;
use common\models\SgdnRelInscricaoViagen;
use common\models\SgdnRelAula;

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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],

        ];
    }


    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionServices()
    {
        return $this->render('services');
    }

    public function actionTeam()
    {
        return $this->render('team');
    }

    public function actionGallery()
    {
        return $this->render('gallery');
    }

    public function actionDashuser()
    {
        $this->layout = "main_services";

        //ultimos 3 residenciais para alojamento
        $residencias = (new \yii\db\Query())
              ->select('*')
              ->from('sgdn_residencia')
              ->orderBy([
                  'DT_REGISTO' => SORT_ASC
              ])
              ->limit(3)
              ->all();

        //ultimos 3 materiais para emprestimo
        $materiais = (new \yii\db\Query())
              ->select('*')
              ->from('sgdn_material')
              ->orderBy([
                  'DT_REGISTO' => SORT_ASC
              ])
              ->limit(3)
              ->all();

        //ultimos 3 aulas para inscricoes
        // $aulas = (new \yii\db\Query())
        //       ->select('*')
        //       ->from('sgdn_rel_aula')
        //       ->orderBy([
        //           'DT_REGISTO' => SORT_ASC
        //       ])
        //       ->limit(3)
        //       ->all();

        $aulas = SgdnRelAula::find()
                ->orderBy([
                'DT_REGISTO' => SORT_DESC
                ])
                ->limit(3)
                ->all();

        //ultimos 3 trips para para inscricoes
        $trips = (new \yii\db\Query())
              ->select('*')
              ->from('sgdn_viagen')
              ->orderBy([
                  'DT_REGISTO' => SORT_ASC
              ])
              ->limit(3)
              ->all();

        // Dashboard scripts
        $user_id = Yii::$app->user->identity->id;
        $id_user_pessoa = SgdnRelUserPessoa::find()->where(['PESSOA_ID' => $user_id])->all();

        $modelAlojamento = SgdnRelAlojamento::find()
                          ->where(['PESSOA_ID' => $id_user_pessoa])
                          ->orderBy([
                          'DT_REGISTO' => SORT_ASC
                          ])
                          ->limit(1)
                          ->all();
        $modelMatricula = SgdnRelMatricula::find()
                          ->where(['PESSOA_ID' => $id_user_pessoa])
                          ->orderBy([
                          'DT_REGISTO' => SORT_ASC
                          ])
                          ->limit(1)
                          ->all();

      $modelAluguer = SgdnRelAluguer::find()
                        ->where(['PESSOA_ID' => $id_user_pessoa])
                        ->orderBy([
                        'DT_REGISTO' => SORT_ASC
                        ])
                        ->limit(1)
                        ->all();
      $modelViagens = SgdnRelInscricaoViagen::find()
                        ->where(['PESSOA_ID' => $id_user_pessoa])
                        ->orderBy([
                        'DT_REGISTO' => SORT_ASC
                        ])
                        ->limit(1)
                        ->all();

     return $this->render('dashuser', [
         'residencias'=>$residencias,
         'materiais' => $materiais,
         'aulas'=> $aulas,
         'trips'=> $trips,

        //  // dashboard returns
        'modelAlojamento'=> $modelAlojamento,
        'modelMatricula'=> $modelMatricula,
        'modelAluguer'=> $modelAluguer,
        'modelViagens'=> $modelViagens

     ]);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
      if (Yii::$app->user->isGuest) {
          return $this->render('index');
      }

      /*$check_pessoa = SgdnRelUserPessoa::findOne(['USER_ID'=>Yii::$app->user->identity->id]);
      if($check_pessoa == NULL)
      {
        return $this->redirect(['sgdn-pessoa/create']);
      }*/
        return $this->redirect(['dashuser']);
        //return $this->redirect(['sgdn-pessoa/_form']);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }


        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['index']);
        } else {
            $model->password = '';

            return $this->renderAjax('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->renderAjax('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
