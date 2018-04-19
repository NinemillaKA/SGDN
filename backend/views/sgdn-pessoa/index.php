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

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sgdn Pessoa', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
