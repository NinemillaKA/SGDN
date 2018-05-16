<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelPrecario */

$this->title = 'Editar Precario';
$this->params['breadcrumbs'][] = ['label' => 'Precarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
  Modal::begin([
    'id' => 'update-modal',
    'size' => 'modal-sm',
    'header' => '<strong>Registar Preçário</strong>',
    'footer' => Html::button('<i class="fa fa-save"></i> Confirmar', ['onclick' => '$("#sgdn-rel-precario-form").submit();', 'class' => 'btn btn-flat btn-primary']),
  ]);
?>

<div class="sgdn-rel-precario-form">

    <?php $form = ActiveForm::begin(['id' => 'sgdn-rel-precario-form']); ?>

    <?= $form->field($model, 'PRECO', [

      'addon' => [
          'prepend' => ['content' => '$', 'options'=>['class'=>'alert-success']],
          'append' => ['content' => '.00', 'options'=>['style' => 'font-family: Monaco, Consolas, monospace;']],
      ]
        ])->label(true);?>

    <?= $form->field($model, 'OBS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ESTADO')->dropDownList(["A"=>"ACTIVO", "I"=>"INACTIVO"],['prompt' =>'*** ESTADO ***', 'class'=>'form-control']) ?>

    <?php ActiveForm::end(); ?>

</div>

<?php
  Modal::end();
?>
