<?php

use yii\helpers\Html;
// use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnViagen */

$this->title = 'Create Sgdn Viagen';
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Viagens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- <-?php
  Modal::begin([
    'id' => 'create-modal',
    'size' => 'modal-lg',
    'header' => '<strong>Registar Viagen</strong>',
    'footer' => Html::button('<i class="fa fa-save"></i> Confirmar', ['onclick' => '$("#sgdn-viagen-form").submit();', 'class' => 'btn btn-flat btn-primary']),
  ]);
?> -->

<div class="sgdn-viagen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<!-- <-?php
  Modal::end();
?> -->
