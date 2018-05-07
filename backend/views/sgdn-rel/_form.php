<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelMatricula */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgdn-rel-matricula-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ALUNO_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AULA_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CODIGO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DATA')->textInput() ?>

    <?= $form->field($model, 'OBS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DT_REGISTO')->textInput() ?>

    <?= $form->field($model, 'ESTADO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRECO')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
