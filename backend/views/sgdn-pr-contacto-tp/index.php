<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SgdnPrContactoTpSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipos de Contactos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sgdn-pr-contacto-tp-index">
  <div class="box box-widget">
      <div class="box-header with-border">
            <?= Html::button('Registar', ['onclick' => 'create("sgdn-pr-contacto-tp/create")', 'class' => 'pull-right btn btn-flat btn-primary']) ?>
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

            //'ID',
            'CODIGO',
            'DESIG',
            'DESCR',
            'DT_REGISTO',
            //'ESTADO',

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
              ],
            ],
        ],
    ]); ?>
  </div>
</div>
</div>

<div id="hidden-content"></div>
