<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelPrecario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgdn-rel-precario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REL_AULA_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REL_MATERIAL_MODALIDADE_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRECO')->textInput() ?>

    <?= $form->field($model, 'OBS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DT_REGISTO')->textInput() ?>

    <?= $form->field($model, 'ESTADO')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
