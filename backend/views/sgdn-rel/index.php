<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SgdnRelMatriculaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sgdn Rel Matriculas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sgdn-rel-matricula-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sgdn Rel Matricula', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'ALUNO_ID',
            'AULA_ID',
            'CODIGO',
            'DATA',
            //'OBS',
            //'DT_REGISTO',
            //'ESTADO',
            //'PRECO',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
