<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelAula */

$this->title = $model->DESIG;
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Rel Aulas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
  Modal::begin([
    'id' => 'view-modal',
    'size' => 'modal-lg',
    'header' => '<strong>Vizualizar Aula/strong>',
  ]);
?>

<div class="sgdn-rel-aula-view">

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
            'SPOT_ID',
            'MODALIDADE_ID',
            'INST_MODALIDADE_ID',
            'DT_INICIO',
            'DT_FIM',
            'DT_REGISTO',
            'HORA_INICIO',
            'HORA_FIM',
            'ESTADO',
            'DESIG',
            'PRECO',
        ],
    ]) ?>

</div>
