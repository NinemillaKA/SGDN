<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\sgdnPessoaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sgdn Pessoas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sgdn-pessoa-index">

  <div class="box box-widget">
      <div class="box-header with-border">
          <!--h1><?= Html::encode($this->title) ?></h1-->
          <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

          <?= Html::a('Registar', ['create'], ['class' => 'btn btn-flat btn-primary pull-right']) ?>

        </div>
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'ID',
                    //'LOCALIDADE_ID',
                    'NOME',
                    //'nATURALIDADE.NACIONALIDADE',
                  'lOCALIDADE.NOME',
                    //'CARGO',

                    'SEXO',
                    'pRESTADOCIVIL.DESIG',
                    'DT_NASC',
                    'nATURALIDADE.NACIONALIDADE',
                    //'NATURALIDADE_ID',
                    //'URL_FOTO:url',
                    //'DT_REGISTO',
                    //'ESTADO',
                    //'SGDN_PESSOA_ID',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
  </div>
</div>
