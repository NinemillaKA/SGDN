z<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SgdnSpotSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sgdn Spots';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sgdn-spot-index">

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
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'ID',
                    'GEOGRAFIA_ID',
                    'CODIGO',
                    'DESIG',
                    'DESCR',
                    //'URL_IMAGEM:url',
                    //'DT_REGISTO',
                    //'ESTADO',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
  </div>
</div>
