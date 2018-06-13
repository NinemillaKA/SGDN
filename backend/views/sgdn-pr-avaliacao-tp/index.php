<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SgdnPrAvaliacaoTpSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sgdn Pr Avaliacao Tps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sgdn-pr-avaliacao-tp-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sgdn Pr Avaliacao Tp', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'CODIGO',
            'DESIG',
            'OBS',
            'DT_REGISTO',
            //'ESTADO',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
