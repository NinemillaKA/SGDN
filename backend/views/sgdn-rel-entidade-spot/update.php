<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelEntidadeSpot */

$this->title = 'Update Sgdn Rel Entidade Spot: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Rel Entidade Spots', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<?php
  Modal::begin([
    'id' => 'update-modal',
    'size' => 'modal-lg',
    'header' => '<strong>Actualizar Instrutor</strong>',
    'footer' => Html::button('<i class="fa fa-save"></i> Confirmar', ['onclick' => '$("#sgdn-rel-entidade-spot-form").submit();', 'class' => 'pull-right btn btn-flat btn-primary']),
  ]);
?>
<div class="sgdn-rel-entidade-spot-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->renderAjax('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php
  Modal::end();
?>
