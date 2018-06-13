<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SgdnRelAvaliacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sgdn Rel Avaliacaos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sgdn-rel-avaliacao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sgdn Rel Avaliacao', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'MATRICULA_ID',
            'AVALIACAO_TP',
            'OBS',
            'DT_REGISTO',
            //'ESTADO',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
