<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelInscricaoViagen */

$this->title = 'Update Sgdn Rel Inscricao Viagen: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Rel Inscricao Viagens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?php
  Modal::begin([
    'id' => 'update-modal',
    'size' => 'modal-lg',
    'header' => '<strong>Actualizar Viagem</strong>',
    'footer' => Html::button('<i class="fa fa-save"></i> Confirmar', ['onclick' => '$("#sgdn-rel-inscricao-viagen-form").submit();', 'class' => 'pull-right btn btn-flat btn-primary']),
  ]);
?>

<div class="sgdn-rel-inscricao-viagen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php
  Modal::end();
?>
