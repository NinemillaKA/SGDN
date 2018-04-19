<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnPrContactoTp */

//$this->title = 'Update Sgdn Pr Contacto Tp: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Pr Contacto Tps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<?php
  Modal::begin([
    'id' => 'update-modal',
    'size' => 'modal-sm',
    'header' => '<strong>Alterar tipo Contacto</strong>',
    'footer' => Html::button('<i class="fa fa-save"></i> Confirmar', ['onclick' => '$("#sgdn-pr-contacto-tp-form").submit();', 'class' => 'pull-right btn btn-flat btn-primary']),
  ]);
?>

<div class="sgdn-pr-contacto-tp-update">

    <h1><?= Html::encode($this->title)?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php
  Modal::end();
?>
