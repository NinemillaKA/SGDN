<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SgdnMenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sgdn Menus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sgdn-menu-index">
    <div class="box box-widget">
        <div class="box-header with-border">
                  <!--h1><?= Html::encode($this->title) ?></h1-->
                  <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                  <!-- <-?= Html::a('Criar Entidade', ['create'], ['class' => 'btn btn-flat btn-primary pull-right']) ?> -->
                  <div class="box-header with-border">
                          <?= Html::button('Registar', ['onclick' => 'js:create("sgdn-menu/create")', 'class' => 'pull-right btn btn-flat btn-primary']) ?>
                  </div>
        </div>
        <div class="box-body">
            <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'rowOptions' => function($model){
                        if($model->ESTADO == 'A'){
                            //$model->ESTADO = 'Active';
                            return ['class'=>'success'];
                        }else{
                            return ['class'=>'danger'];
                        }
                     },
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                    'ID',
                    'DESIG',
                    'DESCR',
                    'CONTROLLER',
                    [
          					 'attribute' => 'ESTADO',
          					  'format' => 'html',
          					 'value' => function ($data) {
          									return ($data->ESTADO!='A')?'<span class="label label-danger">Disabled</span>':'<span class="label label-success">Enabled</span>'; // $data['name'] for array data, e.g. using SqlDataProvider.
          								},
          					 ],
                     // 'MENU_ID.DESIG',
                    //'DT_REGISTO',
                    //'DT_UPDATE',
                    //'ACTION',

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
                                return Html::a(($model['ESTADO'] == 'A') ? '<span class="glyphicon glyphicon-trash"></span>':'<span class="glyphicon glyphicon-refresh"></span>', ['delete', 'id' => $model['ID']],
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
<!--  ddddddddddddddddddddddddddddddddddddddddddddddddd   -->

<!-- <div class="pg-menu-index">
    <div class="panel panel-default">
        <div class="panel-heading ui-draggable-handle">
            <h3 class="panel-title"><-?= Html::encode($this->title) ?></h3>
            <ul class="panel-controls">
               <li>
                 <-?= Html::button('<span class="fa fa-plus"></span>Novo', ['data-url' => Url::to(['create']), 'data-title' => Yii::t('app', 'Register Menu'), 'class' => 'btn btn-primary','data-toggle'=>'modal', 'data-target'=>'#modal_for_forms']); ?>
			    </li>
            </ul>
        </div>

        <div class="panel-body">
        	<-?php foreach (Yii::$app->session->getAllFlashes() as $key => $message):?>
                <div class="alert alert-<-?=$key?>" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <-?=$message?>
                </div>
			<-?php endforeach;?>
			<-?= GridView::widget([
                'dataProvider' => $dataProvider,
				'tableOptions' => ['class' => 'table table-striped table-hover'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'ID',
                    'DESIG',
                    'DESCR',
                    //'ESTADO',
                    'DT_REGISTO:datetime',
                    'DT_UPDATE:datetime',
					[
					 'attribute' => 'ESTADO',
					  'format' => 'html',
					 'value' => function ($data) {
									return ($data->ESTADO!='A')?'<span class="label label-danger">Disabled</span>':'<span class="label label-success">Enabled</span>'; // $data['name'] for array data, e.g. using SqlDataProvider.
								},
					 ],
                    // 'CONTROLLER',
                    // 'ACTION',
                    // 'MENU_ID',
                    // 'pg_perfil_ID',
                    // 'FLAG_DISPLAY',

                    ['class' => 'yii\grid\ActionColumn',
						'buttons' => [

									'view' => function ($url, $model, $key) {
													$options = [
														'title' => Yii::t('yii', 'View'),
														'aria-label' => Yii::t('yii', 'View'),
														'data-pjax' => '0',
														'data-toggle'=>'modal',
														'data-target'=>'#modal_for_forms',
														'data-url' => $url,
														'data-title'=>Yii::t('app', 'View Menu'),
													];
													return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '', $options);
												},

									'update' => function ($url, $model, $key) {
											$options = [
												'title' => Yii::t('yii', 'Update'),
												'aria-label' => Yii::t('yii', 'Update'),
												'data-pjax' => '0',
												'data-toggle'=>'modal',
												'data-target'=>'#modal_for_forms',
												'data-url' => $url,
												'data-title'=>Yii::t('app', 'Update Menu'),
											];
											return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '', $options);
										},
						]
					],
                ],
            ]); ?>
		</div>
	</div>
</div> -->
