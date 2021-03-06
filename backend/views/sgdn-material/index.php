<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SgdnMaterialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sgdn Materials';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sgdn-material-index">

  <div class="box box-widget">

      <div class="box-header with-border">
          <!--h1><?= Html::encode($this->title) ?></h1-->
          <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

          <?= Html::a('Registar', ['create'], ['class' => 'btn btn-flat btn-primary pull-right']) ?>

        </div>
        <div class="boox-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'rowOptions' => function($model){
                    if($model->ESTADO == 'A'){
                        return ['class'=>'success'];
                    }else{
                        return ['class'=>'danger'];
                    }
                 },
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'ID',
                    //'MATERIAL_TP_ID',
                    'CODIGO',
                    'DESIG',
                    //'URL_LOGO:url',
                    'DESCR',
                    'DT_REGISTO',
                    [
                     'attribute'=>'ESTADO',
                     'value'=>function($model){return ($model->ESTADO == 'A')?'Activo':'Inactivo';}
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
  </div>
</div>
