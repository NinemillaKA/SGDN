<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelEntidadeSpot */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Rel Entidade Spots', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
  Modal::begin([
    'id' => 'view-modal',
    'size' => 'modal-lg',
    'header' => '<strong>Vizualizar Instrutor</strong>',
  ]);
?>

<div class="sgdn-rel-entidade-spot-view">

    <h1><?= Html::encode($this->title) ?></h1>



    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary', 'onclick' => 'update("' .Url::to(['update', 'id' => $model->ID]). '")', 'data-dismiss'=>'modal']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p> <br>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID',
            'ENTIDADE_ID',
            'SPOT_ID',
            'DT_REGISTO',
            [
                'attribute'=>'ESTADO',
                'value'=>function($model){return ($model->ESTADO == 'A')?'Activo':'Inactivo';},
            ],
        ],
    ]) ?>

</div>

<?php
  Modal::end();
?>
