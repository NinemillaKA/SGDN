<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnPrMaterialMarca */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgdn-pr-material-marca-form">

    <?php $form = ActiveForm::begin(['id' => 'sgdn-pr-material-marca-form']); ?>

    <?= $form->field($model, 'CODIGO')->textInput(['maxlength' => true, 'disabled'=>true]) ?>

    <?= $form->field($model, 'DESIG')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OBS')->textInput(['maxlength' => true]) ?>
    <?php if (!$model->isNewRecord): ?>
        <?= $form->field($model, 'ESTADO')->dropDownList(["A"=>"ACTIVO", "I"=>"INACTIVO"],['prompt' =>'*** ESTADO ***', 'class'=>'form-control']) ?>
    <?php endif; ?>

    <?php ActiveForm::end(); ?>

</div>
