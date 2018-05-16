<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelPrecario */

$this->title = 'Create Sgdn Rel Precario';
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Rel Precarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
  Modal::begin([
    'id' => 'create-modal',
    'size' => 'modal-lg',
    'header' => '<strong>Registar Preçário</strong>',
    'footer' => Html::button('<i class="fa fa-save"></i> Confirmar', ['onclick' => '$("#sgdn-rel-precario-form").submit();', 'class' => 'btn btn-flat btn-primary']),
  ]);
?>

<div class="sgdn-rel-precario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        //'model' => $model,
        'modelMaterialModalidade' => $modelMaterialModalidade,
    ]) ?>

</div>

<?php
  Modal::end();
?>
