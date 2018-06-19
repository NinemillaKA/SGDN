<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SgdnViagenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sgdn Viagens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sgdn-viagen-index">

  <div class="box box-widget">
      <div class="box-header with-border">
          <!-- <-?= Html::button('Registar', ['onclick' => 'create("sgdn-viagen/create")', 'class' => 'pull-right btn btn-flat btn-primary']) ?> -->
          <?= Html::a('Registar', ['create'], ['class' => 'btn btn-flat btn-primary pull-right']) ?>
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
                  'CODIGO',
                  // 'URL_IMAGEM:url',
                  'DESIG',
                  'DESCR',
                  'GEOGRAFIA_ID',
                  'ENDERECO',
                  'DT_INICIO',
                  'DT_FIM',
                  'PRECO',
                  //'DT_REGISTO',
                  ['class' => 'yii\grid\ActionColumn'],
                 ],
                ]); ?>
       </div>
  </div>
</div>
<!-- <div id="hidden-content"></div> -->
