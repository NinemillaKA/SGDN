<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnPrMetodoPagamento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgdn-pr-metodo-pagamento-form">

    <?php $form = ActiveForm::begin(['id'=>'sgdn-pr-metodo-pagamento-form']); ?>

    <?= $form->field($model, 'CODIGO')->textInput(['maxlength' => true, 'disabled'=>'true']) ?>

    <?= $form->field($model, 'DESIG')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DESCR')->textInput(['maxlength' => true]) ?>

    <?php if (!$model->isNewRecord): ?>
        <?= $form->field($model, 'ESTADO')->dropDownList(["A"=>"ACTIVO", "I"=>"INACTIVO"],['prompt' =>'*** ESTADO ***', 'class'=>'form-control']) ?>
    <?php endif; ?>

    <?php ActiveForm::end(); ?>

</div>
