<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnPrDocumentoTp */

$this->title = 'Update Sgdn Pr Documento Tp: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Pr Documento Tps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?php
  Modal::begin([
    'id' => 'update-modal',
    'size' => 'modal-sm',
    'header' => '<strong>Alterar tipo documento</strong>',
    'footer' => Html::button('<i class="fa fa-save"></i> Confirmar', ['onclick' => '$("#sgdn-pr-documento-tp-form").submit();', 'class' => 'pull-right btn btn-flat btn-primary']),
  ]);
?>

<div class="sgdn-pr-documento-tp-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php
  Modal::end();
?>
