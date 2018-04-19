<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $model backend\models\SgdnPrDocumentoTp */

$this->title = 'Create Sgdn Pr Documento Tp';
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Pr Documento Tps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
  Modal::begin([
    'id' => 'create-modal',
    'size' => 'modal-sm',
    'header' => '<strong>Registar tipo documento</strong>',
    'footer' => Html::button('<i class="fa fa-save"></i> Confirmar', ['onclick' => '$("#sgdn-pr-documento-tp-form").submit();', 'class' => 'btn btn-flat btn-primary']),
  ]);
?>

<div class="sgdn-pr-documento-tp-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php
  Modal::end();
?>
