<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelInstrutorModalidade */

$this->title = 'Update Sgdn Rel Instrutor Modalidade: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Rel Instrutor Modalidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?php
  Modal::begin([
    'id' => 'update-modal',
    'size' => 'modal-lg',
    'header' => '<strong>Actualizar Instrutor</strong>',
    'footer' => Html::button('<i class="fa fa-save"></i> Confirmar', ['onclick' => '$("#sgdn-rel-instrutor-modalidade-form").submit();', 'class' => 'pull-right btn btn-flat btn-primary']),
  ]);
?>

<div class="sgdn-rel-instrutor-modalidade-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->renderAjax('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php
  Modal::end();
?>
