<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SgdnRelAlojamentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sgdn Rel Alojamentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sgdn-rel-alojamento-index">

    <div class="box box-widget">
        <div class="box-header with-border">
                <?= Html::button('Registar', ['onclick' => 'create("sgdn-rel-alojamento/create")', 'class' => 'pull-right btn btn-flat btn-primary']) ?>
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

                    // 'ID',
                    'PESSOA_ID',
                    'RESIDENCIA_ID',
                    'OBS',
                    'DT_ENTRADA',
                    'DT_SAIDA',
                    //'TOTAL',
                    //'DT_REGISTO',
                    [
                      'attribute'=>'ESTADO',
                      'value'=>function($model){return ($model->ESTADO == 'A')?'Activo':'Inactivo';}
                    ],
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
