<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <div class="box box-widget">
        <div class="box-header with-border">
                  <!--h1><?= Html::encode($this->title) ?></h1-->
                  <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                  <!-- <-?= Html::a('Criar Entidade', ['create'], ['class' => 'btn btn-flat btn-primary pull-right']) ?> -->
                  <div class="box-header with-border">
                          <?= Html::button('Registar', ['onclick' => 'js:create("user/create")', 'class' => 'pull-right btn btn-flat btn-primary']) ?>
                  </div>
        </div>
        <div class="box-body">
            <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'rowOptions' => function($model){
                        if($model->estado == 'A'){
                            //$model->ESTADO = 'Active';
                            return ['class'=>'success'];
                        }else{
                            return ['class'=>'danger'];
                        }
                     },
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                    // 'id',
                    // 'name',
                    'username',
                    'password_hash',
                    'email:email',
                    //'sgdn_rel_perfil_ID',
                    //'url_perfil:url',
                    //'dt_registo',
                    //'dt_updated',
                    //'estado',
                    //'status',

                    [
                      'class' => 'yii\grid\ActionColumn',
                      'template' => '{view}{update}{delete}',
                      'buttons' => [
                            'view' => function($url, $model, $key) {
                                  return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '#', [
                                    'onclick' => 'view("' .$url. '")',
                                  ]);
                              },
                            'update' => function($url, $model, $key) {
                                  return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#', [
                                    'onclick' => 'update("' .$url. '")',
                                  ]);
                            },
                            'delete' => function($url, $model){
                                return Html::a(($model['estado'] == 'A') ? '<span class="glyphicon glyphicon-trash"></span>':'<span class="glyphicon glyphicon-refresh"></span>', ['delete', 'id' => $model['id']],
                                [ 'class' => '',
                                     'data' => [ 'confirm' => 'Are you absolutely sure ? You will lose all the information about this user with this action.', 'method' => 'post', ],
                                     ]);
                              },
                       ],

                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
<div id="hidden-content"></div>
