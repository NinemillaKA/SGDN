<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnPrMetodoPagamento */

$this->title = 'Create Sgdn Pr Metodo Pagamento';
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Pr Metodo Pagamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
  Modal::begin([
    'id' => 'create-modal',
    'size' => 'modal-sm',
    'header' => '<strong>Registar Metodos de Pagamento</strong>',
    'footer' => Html::button('<i class="fa fa-save"></i> Confirmar', ['onclick' => '$("#sgdn-pr-metodo-pagamento-form").submit();', 'class' => 'btn btn-flat btn-primary']),
  ]);
?>
<div class="sgdn-pr-metodo-pagamento-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php
  Modal::end();
?>
