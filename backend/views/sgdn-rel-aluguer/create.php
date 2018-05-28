<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
//use backend\models\SgdnRelAluguer;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelAluguer */

$this->title = 'Create Sgdn Rel Aluguer';
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Rel Aluguers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
  Modal::begin([
    'id' => 'create-modal',
    'size' => 'modal-lg',
    'header' => '<strong>Registar Aluguer</strong>',
    'footer' => Html::button('<i class="fa fa-save"></i> Confirmar', ['onclick' => '$("#sgdn-rel-aluguer-form").submit();', 'class' => 'btn btn-flat btn-primary']),
  ]);
?>

<div class="sgdn-rel-aluguer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        //'model' => $model,
        'modelsSgdnRelAluger' => $modelsSgdnRelAluger,
    ]) ?>


</div>

<?php
  Modal::end();
?>
