<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnPrEstadoCivil */

$this->params['breadcrumbs'][] = ['label' => 'Sgdn Pr Estado Civils', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
  Modal::begin([
    'id' => 'create-modal',
    'size' => 'modal-sm',
    'header' => '<strong>Registar tipo documento</strong>',
    'footer' => Html::button('<i class="fa fa-save"></i> Confirmar', ['onclick' => '$("#sgdn-pr-estado-civil-form").submit();', 'class' => 'btn btn-flat btn-primary']),
    
  ]);
?>
    <div class="sgdn-pr-estado-civil-create">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
<?php
  Modal::end();
?>
