<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelInstrutorModalidade */

$this->title = 'Create Sgdn Rel Instrutor Modalidade';
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Rel Instrutor Modalidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
  Modal::begin([
    'id' => 'create-modal',
    'size' => 'modal-lg',
    'header' => '<strong>Contratar Instrutor</strong>',
    'footer' => Html::button('<i class="fa fa-save"></i> Confirmar', ['onclick' => '$("#sgdn-rel-instrutor-modalidade-form").submit();', 'class' => 'btn btn-flat btn-primary']),
  ]);
?>

<div class="sgdn-rel-instrutor-modalidade-create">

    <!-- <h1><-?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php
  Modal::end();
?>
