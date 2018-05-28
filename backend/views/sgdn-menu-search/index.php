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

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sgdn Menu', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'DESIG',
            'DESCR',
            'CONTROLLER',
            'ESTADO',
            //'DT_REGISTO',
            //'DT_UPDATE',
            //'ACTION',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
