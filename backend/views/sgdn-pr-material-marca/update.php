<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model backend\models\SgdnPrMaterialMarca */

$this->title = 'Update Sgdn Pr Material Marca: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Pr Material Marcas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<?php
  Modal::begin([
    'id' => 'update-modal',
    'size' => 'modal-sm',
    'header' => '<strong>Alterar Marca do Material</strong>',
    'footer' => Html::button('<i class="fa fa-save"></i> Confirmar', ['onclick' => '$("#sgdn-pr-material-marca-form").submit();', 'class' => 'pull-right btn btn-flat btn-primary']),
  ]);
?>
<div class="sgdn-pr-material-marca-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php
  Modal::end();
?>
