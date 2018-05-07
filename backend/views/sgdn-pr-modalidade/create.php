<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $model backend\models\SgdnPrModalidade */

$this->title = 'Create Sgdn Pr Modalidade';
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Pr Modalidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
  Modal::begin([
    'id' => 'create-modal',
    'size' => 'modal-lg',
    'header' => '<strong>Registar Modalidade</strong>',
    'footer' => Html::button('<i class="fa fa-save"></i> Confirmar', ['onclick' => '$("#sgdn-pr-modalidade-form").submit();', 'class' => 'btn btn-flat btn-primary']),
  ]);
?>

<div class="sgdn-pr-modalidade-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php
  Modal::end();
?>
