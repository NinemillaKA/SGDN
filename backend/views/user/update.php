<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = 'Update User: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?php
  Modal::begin([
    'id' => 'update-modal',
    'size' => 'modal-lg',
    'header' => '<strong>Actualizar Instrutor</strong>',
    'footer' => Html::button('<i class="fa fa-save"></i> Confirmar', ['onclick' => '$("#user-form").submit();', 'class' => 'pull-right btn btn-flat btn-primary']),
  ]);
?>

<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php
  Modal::end();
?>
