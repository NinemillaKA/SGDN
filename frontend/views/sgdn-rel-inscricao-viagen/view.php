<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model commom\models\SgdnRelInscricaoViagen */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Rel Inscricao Viagens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
  Modal::begin([
    'id' => 'view-modal',
    'size' => 'modal-lg',
    'header' => '<strong>Vizualizar Inscricoe da Viagem</strong>',
  ]);
?>

<div class="sgdn-rel-inscricao-viagen-view">

    <?= Html::a('Update', ['update', 'id' => $model->ID], ['onclick' => '$("#sgdn-rel-inscricao-viagem-form").submit();', 'class' => 'btn btn-primary btn-flat', 'onclick' => 'update("' .Url::to(['update', 'id' => $model->ID]). '")', 'data-dismiss'=>'modal']) ?>
    <!-- <-?= Html::button('Update', ['onclick' => '$("#sgdn-pr-modalidade-form").submit();', 'class' => 'btn btn-primary btn-flat']) ?> -->
    <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
        'class' => 'btn btn-danger btn-flat',
        'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
        ],
    ]) ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID',
            'VIAGEM_ID',
            'PESSOA_ID',
            'INSTRUTOR_ID',
            'DATA',
            'DT_REGISTO',
            'ESTADO',
        ],
    ]) ?>

</div>

<?php
  Modal::end();
?>
