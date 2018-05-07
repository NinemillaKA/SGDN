<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelEntidadeSpot */

$this->title = 'Create Sgdn Rel Entidade Spot';
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Rel Entidade Spots', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
  Modal::begin([
    'id' => 'create-modal',
    'size' => 'modal-lg',
    'header' => '<strong>Contratar Instrutor</strong>',
    'footer' => Html::button('<i class="fa fa-save"></i> Confirmar', ['onclick' => '$("#sgdn-rel-entidade-spot-form").submit();', 'class' => 'btn btn-flat btn-primary']),
  ]);
?>

<div class="sgdn-rel-entidade-spot-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php
  Modal::end();
?>
