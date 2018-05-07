<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $model backend\models\SgdmInstrutor */

$this->title = 'Create Sgdm Instrutor';
$this->params['breadcrumbs'][] = ['label' => 'Sgdm Instrutors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
  Modal::begin([
    'id' => 'create-modal',
    'size' => 'modal-lg',
    'header' => '<strong>Cadastrar Instrutor</strong>',
    'footer' => Html::button('<i class="fa fa-save"></i> Confirmar', ['onclick' => '$("#sgdm-instrutor-form").submit();', 'class' => 'btn btn-flat btn-primary']),
  ]);
?>

<div class="sgdm-instrutor-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php
  Modal::end();
?>
